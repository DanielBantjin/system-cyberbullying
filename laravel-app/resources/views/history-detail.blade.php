@extends('layouts.app')

@section('title', 'Detail Analisis')

@section('content')

    <div class="space-y-6">
        <div>

            <a href="{{ route('history') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                </svg>

                Kembali ke Riwayat

            </a>

        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200">

            <h1 class="text-3xl font-bold">
                Detail Analisis
            </h1>

            <p class="text-slate-500 mt-2">
                Informasi hasil analisis yang tersimpan.
            </p>

        </div>

        <div class="grid md:grid-cols-5 gap-6">

            <div class="bg-white rounded-2xl p-6 border">
                <p class="text-slate-500">Total Komentar</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $analysis->total_comments }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl p-6 border">
                <p class="text-slate-500">Cyberbullying</p>
                <h2 class="text-3xl font-bold text-red-500 mt-2">
                    {{ $analysis->cyberbullying_count }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl p-6 border">
                <p class="text-slate-500">Non Bullying</p>
                <h2 class="text-3xl font-bold text-green-500 mt-2">
                    {{ $analysis->non_bullying_count }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl p-6 border">
                <p class="text-slate-500">Persentase</p>
                <h2 class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $analysis->cyberbullying_percentage }}%
                </h2>
            </div>

            <div class="bg-white rounded-2xl p-6 border">
                <p class="text-slate-500">Waktu Analisis</p>
                <h2 class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $analysis->analysis_time ?? 0 }} s
                </h2>
            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden">

            <div class="p-6 border-b">

                <h2 class="text-xl font-semibold">
                    Daftar Komentar
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Komentar
                            </th>

                            <th class="px-6 py-4 text-center">
                                Kategori
                            </th>

                            <th class="px-6 py-4 text-center">
                                Confidence
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($comments as $comment)

                            <tr class="border-t">

                                <td class="px-6 py-4">
                                    {{ $comment->comment }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $comment->category }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ number_format($comment->confidence, 2) }}%
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection