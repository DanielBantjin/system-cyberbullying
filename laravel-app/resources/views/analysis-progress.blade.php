@extends('layouts.app')

@section('title', 'Progress Analisis')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-10">

        <h1 class="text-3xl font-bold text-slate-800">
            Analisis Sedang Berjalan
        </h1>

        <p class="text-slate-500 mt-3">
            Sistem sedang mengambil dan menganalisis komentar YouTube.
        </p>

        <div class="mt-10">

            <div class="flex justify-between mb-2">

                <span class="text-slate-600 font-medium">
                    Progress
                </span>

                <span
                    id="progressText"
                    class="font-bold text-blue-600">

                    0%

                </span>

            </div>

            <div
                class="w-full bg-slate-200 rounded-full h-5">

                <div
                    id="progressBar"
                    class="bg-blue-600 h-5 rounded-full transition-all duration-500"
                    style="width:0%">
                </div>

            </div>

        </div>

        <div
            id="statusText"
            class="mt-6 text-slate-600">

            Menunggu proses...

        </div>

        <div
            id="processedText"
            class="mt-2 text-slate-500 text-sm">

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

const jobId = "{{ $jobId }}";

function updateProgress()
{
    fetch(
        `http://127.0.0.1:8001/progress/${jobId}`
    )
    .then(response => response.json())
    .then(data => {

        let progress =
            data.progress || 0;

        document
            .getElementById(
                'progressBar'
            )
            .style.width =
            progress + '%';

        document
            .getElementById(
                'progressText'
            )
            .innerHTML =
            progress + '%';

        document
            .getElementById(
                'statusText'
            )
            .innerHTML =
            data.status || '';

        if (
            data.processed &&
            data.total
        ) {

            document
                .getElementById(
                    'processedText'
                )
                .innerHTML =
                data.processed +
                ' / ' +
                data.total +
                ' komentar';
        }

        if (
            data.status === 'completed'
        ) {

            window.location =
                "/youtube/result/" +
                jobId;

            return;
        }

        if (
            data.status === 'error'
        ) {

            document
                .getElementById(
                    'statusText'
                )
                .innerHTML =
                'Terjadi kesalahan: ' +
                (data.message || '');

            return;
        }

        setTimeout(
            updateProgress,
            2000
        );

    })
    .catch(() => {

        setTimeout(
            updateProgress,
            3000
        );

    });
}

updateProgress();

</script>

@endpush