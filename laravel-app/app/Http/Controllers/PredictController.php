<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\YoutubeAnalysis;
use App\Models\YoutubeComment;

class PredictController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | START ANALISIS
    |--------------------------------------------------------------------------
    */

    public function predictYoutube(Request $request)
    {
        $request->validate([
            'url' => 'required|string'
        ]);

        try {

            $response = Http::timeout(30)->post(
                'http://127.0.0.1:8001/predict-youtube',
                [
                    'url' => $request->url
                ]
            );

            if (!$response->successful()) {

                return back()->with(
                    'error',
                    'Gagal terhubung ke server AI.'
                );
            }

            $data = $response->json();

            if (!isset($data['job_id'])) {

                return back()->with(
                    'error',
                    'Job ID tidak ditemukan.'
                );
            }

            return redirect()->route(
                'predict.progress',
                [
                    'jobId' => $data['job_id']
                ]
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PROGRESS
    |--------------------------------------------------------------------------
    */

    public function progress($jobId)
    {
        return view(
            'analysis-progress',
            compact('jobId')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AMBIL HASIL ANALISIS
    |--------------------------------------------------------------------------
    */

    public function result($jobId)
    {
        try {

            $response = Http::timeout(60)->get(
                "http://127.0.0.1:8001/progress/$jobId"
            );

            if (!$response->successful()) {

                return back()->with(
                    'error',
                    'Gagal mengambil hasil analisis.'
                );
            }

            $result = $response->json();

            if (
                !isset($result['status']) ||
                $result['status'] !== 'completed'
            ) {

                return redirect()->route(
                    'predict.progress',
                    [
                        'jobId' => $jobId
                    ]
                );
            }

            $analysis = YoutubeAnalysis::create([

                'video_url' =>
                    $result['video_url'] ?? '',

                'thumbnail' =>
                    $result['thumbnail'] ?? null,

                'total_comments' =>
                    $result['total_comments'] ?? 0,

                'cyberbullying_count' =>
                    $result['cyberbullying_count'] ?? 0,

                'non_bullying_count' =>
                    $result['non_bullying_count'] ?? 0,

                'invalid_count' =>
                    $result['invalid_count'] ?? 0,

                'cyberbullying_percentage' =>
                    $result['cyberbullying_percentage'] ?? 0,

                'analysis_time' =>
                    $result['analysis_time'] ?? 0
            ]);

            foreach (
                $result['results'] ?? []
                as $item
            ) {

                YoutubeComment::create([

                    'youtube_analysis_id' =>
                        $analysis->id,

                    'comment' =>
                        $item['comment'] ?? '',

                    'category' =>
                        $item['category'] ?? '',

                    'confidence' =>
                        $item['confidence'] ?? 0

                ]);
            }

            return view(
                'analysis',
                [
                    'data' => $result,
                    'analysis' => $analysis
                ]
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT ANALISIS
    |--------------------------------------------------------------------------
    */

    public function history()
    {
        $histories = YoutubeAnalysis::latest()
            ->paginate(10);

        return view(
            'history',
            compact('histories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL RIWAYAT
    |--------------------------------------------------------------------------
    */

    public function historyDetail($id)
    {
        $analysis = YoutubeAnalysis::findOrFail($id);

        $comments = YoutubeComment::where(
            'youtube_analysis_id',
            $analysis->id
        )
            ->orderBy('id', 'asc')
            ->paginate(25);

        return view(
            'history-detail',
            [
                'analysis' => $analysis,
                'comments' => $comments
            ]
        );
    }
}