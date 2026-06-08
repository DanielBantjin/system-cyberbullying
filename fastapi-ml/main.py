from fastapi import FastAPI, BackgroundTasks
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
import os
from transformers import AutoTokenizer, AutoModelForSequenceClassification
from langdetect import detect
from youtube_comment_downloader import YoutubeCommentDownloader
import torch
import torch.nn.functional as F
import uuid
import json
import time
import shutil
import re

from pathlib import Path

# ==================================================
# APP
# ==================================================

app = FastAPI(title="Cyberbullying Detection API", version="3.0")

# ==================================================
# CORS
# ==================================================

app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://127.0.0.1:8000", "http://localhost:8000"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# ==================================================
# JOB STORAGE
# ==================================================

JOB_DIR = Path("jobs")

JOB_DIR.mkdir(exist_ok=True)

# ==================================================
# MODEL
# ==================================================

MODEL_PATH = "./indobert_modelC"

print("Loading tokenizer...")
print("Folder ada :", os.path.exists(MODEL_PATH))
print("Isi folder :", os.listdir(MODEL_PATH))
tokenizer = AutoTokenizer.from_pretrained(MODEL_PATH)

print("Loading model...")

model = AutoModelForSequenceClassification.from_pretrained(MODEL_PATH)

device = torch.device("cuda" if torch.cuda.is_available() else "cpu")

model.to(device)

model.eval()

print("Using Device:", device)

# ==================================================
# LABEL MAP
# ==================================================

label_map = {0: "non_bullying", 1: "cyberbullying", 2: "undefined"}

# ==================================================
# REQUEST SCHEMA
# ==================================================


class TextRequest(BaseModel):
    text: str


class YoutubeRequest(BaseModel):
    url: str


# ==================================================
# JOB FILE HELPER
# ==================================================


def get_job_file(job_id: str):

    return JOB_DIR / f"{job_id}.json"


def save_job(job_id: str, data: dict):

    job_file = get_job_file(job_id)

    with open(job_file, "w", encoding="utf-8") as f:

        json.dump(data, f, ensure_ascii=False)


def load_job(job_id: str):

    job_file = get_job_file(job_id)

    if not job_file.exists():

        return None

    with open(job_file, "r", encoding="utf-8") as f:

        return json.load(f)


def update_job(job_id: str, updates: dict):

    current = load_job(job_id)

    if current is None:
        current = {}

    current.update(updates)

    save_job(job_id, current)


# ==================================================
# AUTO CLEANUP
# ==================================================


def cleanup_old_jobs():

    try:

        now = time.time()

        for file in JOB_DIR.glob("*.json"):

            age = now - file.stat().st_mtime

            if age > 3600:

                file.unlink()

    except Exception as e:

        print("Cleanup Error:", e)


# ==================================================
# THUMBNAIL
# ==================================================


def get_thumbnail(url):

    try:

        video_id = None

        if "v=" in url:

            video_id = url.split("v=")[1].split("&")[0]

        elif "youtu.be/" in url:

            video_id = url.split("youtu.be/")[1].split("?")[0]

        if video_id:

            return f"https://img.youtube.com/vi/" f"{video_id}/hqdefault.jpg"

    except Exception:

        pass

    return None


# ==================================================
# PREPROCESSING
# ==================================================


def preprocess_text(text):

    text = text.lower()

    text = re.sub(r"http\S+|www\S+", " ", text)

    text = re.sub(r"@\w+", " ", text)

    text = re.sub(r"#", "", text)

    text = re.sub(r"[^\w\s!?.,]", " ", text)

    text = re.sub(r"\s+", " ", text)

    return text.strip()

def is_indonesian(text):

    try:
        return detect(text) == "id"
    except:
        return False
    

def is_noise(text):

    text = text.strip()

    # hanya simbol
    if re.fullmatch(r'[\W_]+', text):
        return True

    # terlalu pendek
    if len(text.strip()) < 3:
        return True

    return False
# ==================================================
# HOME
# ==================================================


@app.get("/")
def home():

    return {"message": "Cyberbullying API Background Mode"}


# ==================================================
# BATCH PREDICTION
# ==================================================


def predict_batch(texts):

    processed_texts = [preprocess_text(text) for text in texts]

    inputs = tokenizer(
        processed_texts,
        return_tensors="pt",
        truncation=True,
        padding=True,
        max_length=128,
    )

    inputs = {k: v.to(device) for k, v in inputs.items()}

    with torch.no_grad():

        outputs = model(**inputs)

    probabilities = F.softmax(outputs.logits, dim=1)

    results = []

    for i, prob in enumerate(probabilities):

        probs = prob.tolist()

        predicted_class = torch.argmax(prob).item()
        text = processed_texts[i]

        confidence = probs[predicted_class] * 100

        sorted_probs = sorted(probs, reverse=True)

        gap = (sorted_probs[0] - sorted_probs[1]) * 100

        need_review = False

        results.append(
            {
                "label": predicted_class,
                "category": label_map.get(predicted_class, "unknown"),
                "confidence": round(confidence, 2),
                "gap": round(gap, 2),
                "need_review": need_review,
                "processed_text": processed_texts[i],
            }
        )

    return results


# ==================================================
# TEXT ANALYSIS
# ==================================================


@app.post("/predict-text")
def predict_single_text(req: TextRequest):

    result = predict_batch([req.text])

    return result[0]


# ==================================================
# BACKGROUND WORKER
# ==================================================


def process_youtube_job(job_id: str, url: str):
    print("\n" + "="*60)
    print("PROSES ANALISIS DIMULAI")
    print("Job ID :", job_id)
    print("URL    :", url)
    print("="*60)
    try:
        start_time = time.time()

        update_job(job_id, {"status": "fetching_comments", "progress": 0})

        print(f"[{job_id}] " f"Fetching comments...")

        downloader = YoutubeCommentDownloader()

        comments = downloader.get_comments_from_url(url)

        all_comments = []

        # ==========================================
        # Scraping Comments
        # ==========================================

        MAX_COMMENTS = None

        for comment in comments:

            text = comment.get("text", "").strip()

            if len(text) < 3:
                continue

            all_comments.append(text)


        total_comments = len(all_comments)

        print("\n" + "="*60)
        print("SCRAPING KOMENTAR SELESAI")
        print("Total komentar :", total_comments)
        print("="*60)

# ==========================================
# Filter Komentar Indonesia
# ==========================================

        total_comments = len(all_comments)

        if total_comments == 0:

            update_job(
                job_id,
                {
                    "status": "error",
                    "progress": 0,
                    "message": "Tidak ditemukan komentar yang dapat dianalisis."
                }
            )

            return

        indonesian_comments = []

        for text in all_comments:

            try:

                if is_indonesian(text):
                    indonesian_comments.append(text)

            except:
                pass

        # Tidak ada komentar Indonesia

        if len(indonesian_comments) == 0:

            update_job(
                job_id,
                {
                    "status": "error",
                    "progress": 0,
                    "message": "Konten tidak mengandung komentar berbahasa Indonesia sehingga analisis tidak dapat dilakukan."
                }
            )

            return

        ratio = len(indonesian_comments) / total_comments

        # Kebanyakan bukan Indonesia

        if ratio < 0.20:

            update_job(
                job_id,
                {
                    "status": "error",
                    "progress": 0,
                    "message": "Mayoritas komentar bukan berbahasa Indonesia sehingga analisis tidak dapat dilakukan."
                }
            )

            return

        # komentar Indonesia

        all_comments = indonesian_comments

        total_comments = len(all_comments)
        print("=" * 50)
        print(f"TOTAL KOMENTAR DIAMBIL: {total_comments}")
        print("=" * 50)
        
        print(f"[{job_id}] " f"Comments: " f"{total_comments}")
        
        if total_comments == 0:
            update_job(
                job_id,
                {
                    "status": "completed",
                    "progress": 100,
                    "video_url": url,
                    "thumbnail": get_thumbnail(url),
                    "total_comments": 0,
                    "cyberbullying_count": 0,
                    "non_bullying_count": 0,
                    "invalid_count": 0,
                    "cyberbullying_percentage": 0,
                    "results": [],
                },
            )

            return

        update_job(
            job_id,
            {
                "status": "analyzing",
                "progress": 5,
                "processed": 0,
                "total": total_comments,
            },
        )

        results = []

        bullying_count = 0
        non_bullying_count = 0
        invalid_count = 0

        BATCH_SIZE = 16

        total_batches = (total_comments + BATCH_SIZE - 1) // BATCH_SIZE

        current_batch = 0

        for i in range(0, total_comments, BATCH_SIZE):

            current_batch += 1

            batch_comments = all_comments[i : i + BATCH_SIZE]

            batch_predictions = predict_batch(batch_comments)

            for text, prediction in zip(batch_comments, batch_predictions):

                label = prediction["label"]

                if label == 1:

                    bullying_count += 1

                elif label == 0:

                    non_bullying_count += 1

                else:

                    invalid_count += 1

                results.append(
                    {
                        "comment": text,
                        "category": prediction["category"],
                        "confidence": prediction["confidence"],
                        "gap": prediction["gap"],
                        "need_review": prediction["need_review"],
                    }
                )

            progress = int((current_batch / total_batches) * 95)

            update_job(
                job_id,
                {
                    "status": "analyzing",
                    "progress": progress,
                    "processed": len(results),
                    "total": total_comments,
                },
            )

        bullying_percentage = round((bullying_count / total_comments) * 100, 2)
        analysis_time = round(time.time() - start_time, 2)
        print("\n" + "=" * 60)
        print("HASIL ANALISIS")
        print("Job ID        :", job_id)
        print("Total         :", total_comments)
        print("Cyberbullying :", bullying_count)
        print("Non-Bullying  :", non_bullying_count)
        print("Undefined     :", invalid_count)
        print("Persentase CB :", bullying_percentage, "%")
        print("Waktu         :", analysis_time, "detik")
        print("=" * 60)
        update_job(
            job_id,
            {
                "status": "completed",
                "progress": 100,
                "video_url": url,
                "thumbnail": get_thumbnail(url),
                "total_comments": total_comments,
                "cyberbullying_count": bullying_count,
                "non_bullying_count": non_bullying_count,
                "invalid_count": invalid_count,
                "cyberbullying_percentage": bullying_percentage,
                "analysis_time": analysis_time,
                "results": results,
            },
        )

        print(f"[{job_id}] COMPLETE")


    except Exception as e:

        print(f"[{job_id}] ERROR:", e)

        update_job(job_id, {"status": "error", "progress": 0, "message": str(e)})


# ==================================================
# START YOUTUBE ANALYSIS
# ==================================================


@app.post("/predict-youtube")
def predict_youtube(
    req: YoutubeRequest,
    background_tasks: BackgroundTasks
):

    url = req.url

    print("\n" + "="*60)
    print("REST API REQUEST DITERIMA")
    print("Endpoint : /predict-youtube")
    print("Method   : POST")
    print("URL      :", url)
    print("="*60)

    job_id = str(uuid.uuid4())

    save_job(
        job_id,
        {
            "status": "queued",
            "progress": 0
        }
    )

    background_tasks.add_task(
        process_youtube_job,
        job_id,
        url
    )

    return {
        "job_id": job_id,
        "status": "started"
    }

# ==================================================
# GET PROGRESS
# ==================================================


@app.get("/progress/{job_id}")
def get_progress(job_id: str):

    job = load_job(job_id)

    if job is None:

        return {"status": "not_found"}

    return job


# ==================================================
# RUN APP
# ==================================================

if __name__ == "__main__":

    import uvicorn

    uvicorn.run("main:app", host="0.0.0.0", port=8001, reload=True)
