@extends('layouts.app')

@section('title', 'Analisis')

@section('content')

    <div class="max-w-7xl mx-auto">

        {{-- ERROR --}}
        @if(session('error'))

            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl">

                {{ session('error') }}

            </div>

        @endif

        {{-- FORM ANALISIS --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Analisis Komentar YouTube
            </h1>

            <p class="text-slate-500 mt-3 leading-7">
                Masukkan URL video YouTube untuk melakukan analisis komentar
                menggunakan model Cyberbullying Detection System.
            </p>

            <form method="POST" action="{{ route('predict.youtube') }}" class="mt-8" id="analysisForm">

                @csrf

                <div class="flex flex-col lg:flex-row gap-4">

                    <input type="text" name="url" value="{{ old('url') }}" placeholder="https://www.youtube.com/watch?v=..."
                        required
                        class="flex-1 h-14 px-5 rounded-2xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button id="analyzeBtn" type="submit"
                        class="h-14 px-8 rounded-2xl bg-blue-600 text-white font-medium hover:bg-blue-700 transition">

                        Analisis

                    </button>

                </div>

            </form>

        </div>

        @if(!empty($data))

            {{-- RINGKASAN --}}
            <div class="grid lg:grid-cols-5 md:grid-cols-2 gap-6 mt-8">

                <div class="bg-white rounded-3xl border border-slate-200 p-6">

                    <p class="text-slate-500 text-sm">
                        Total Komentar
                    </p>

                    <h2 class="text-4xl font-bold text-slate-800 mt-3">
                        {{ $data['total_comments'] ?? 0 }}
                    </h2>

                </div>

                <div class="bg-white rounded-3xl border border-slate-200 p-6">

                    <p class="text-slate-500 text-sm">
                        Cyberbullying
                    </p>

                    <h2 class="text-4xl font-bold text-red-500 mt-3">
                        {{ $data['cyberbullying_count'] ?? 0 }}
                    </h2>

                </div>

                <div class="bg-white rounded-3xl border border-slate-200 p-6">

                    <p class="text-slate-500 text-sm">
                        Non Bullying
                    </p>

                    <h2 class="text-4xl font-bold text-green-500 mt-3">
                        {{ $data['non_bullying_count'] ?? 0 }}
                    </h2>

                </div>

                <div class="bg-white rounded-3xl border border-slate-200 p-6">

                    <p class="text-slate-500 text-sm">
                        Undifined
                    </p>

                    <h2 class="text-4xl font-bold text-orange-500 mt-3">
                        {{ $data['invalid_count'] ?? 0 }}
                    </h2>

                </div>

                <div class="bg-white rounded-3xl border border-slate-200 p-6">

                    <p class="text-slate-500 text-sm">
                        Waktu Analisis
                    </p>

                    <h2 class="text-4xl font-bold text-blue-600 mt-3">
                        {{ $data['analysis_time'] ?? 0 }}s
                    </h2>

                </div>

            </div>

            {{-- INFO ANALISIS --}}
            <div class="mt-8 bg-blue-50 border border-blue-100 rounded-3xl p-6">

                <h3 class="font-semibold text-blue-700 text-lg">
                    Ringkasan Analisis
                </h3>

                <p class="text-slate-600 mt-3 leading-7">

                    Sistem berhasil memproses

                    <strong>
                        {{ $data['total_comments'] ?? 0 }}
                    </strong>

                    komentar dalam waktu

                    <strong>
                        {{ $data['analysis_time'] ?? 0 }} detik
                    </strong>.

                </p>

            </div>

            {{-- HASIL ANALISIS --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 mt-8">

                <div class="flex flex-col md:flex-row justify-between gap-4 mb-8">

                    <div>

                        <h2 class="text-2xl font-semibold text-slate-800">
                            Hasil Analisis Komentar
                        </h2>

                        <p class="text-slate-500 mt-1">
                            Daftar komentar yang telah dianalisis oleh sistem.
                        </p>

                    </div>

                    <a href="{{ route('export.excel') }}"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-green-600 text-white hover:bg-green-700">

                        Export Excel

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-slate-200">

                                <th class="text-left py-4 font-semibold">
                                    Komentar
                                </th>

                                <th class="text-left py-4 font-semibold">
                                    Kategori
                                </th>

                                <th class="text-left py-4 font-semibold">
                                    Confidence
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @if(isset($data['results']) && is_array($data['results']))

                                @foreach($data['results'] as $item)

                                    <tr class="border-b border-slate-100 hover:bg-slate-50">

                                        <td class="py-4 pr-4">
                                            {{ $item['comment'] }}
                                        </td>

                                        <td>

                                            @if($item['category'] == 'cyberbullying')

                                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-sm">
                                                    Cyberbullying
                                                </span>

                                            @elseif($item['category'] == 'undefined')

                                                <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-sm">
                                                    Undefined
                                                </span>

                                            @else

                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-sm">
                                                    Non Bullying
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            {{ number_format($item['confidence'], 2) }}%
                                        </td>

                                    </tr>

                                @endforeach

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

        @endif

    </div>

@endsection

@push('scripts')

    <script>

        document.getElementById('analysisForm').addEventListener('submit', function () {

            let btn = document.getElementById('analyzeBtn');

            btn.disabled = true;

            btn.innerHTML = `
            <span class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24">

                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4">
                    </circle>

                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v8H4z">
                    </path>

                </svg>

                Menganalisis...
            </span>
        `;
        });

    </script>

@endpush