@extends('layouts.app')

@section('title', 'Riwayat Analisis')

@section('content')

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

    <!-- HEADER -->
    <div class="p-8 border-b border-slate-200">

        <h1 class="text-3xl font-bold text-slate-800">
            Riwayat Analisis
        </h1>

        <p class="text-slate-500 mt-2">
            Daftar seluruh analisis komentar YouTube yang telah dilakukan.
        </p>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-slate-50 text-slate-700">

                    <th class="px-6 py-4 text-left">
                        No
                    </th>

                    <th class="px-6 py-4 text-left">
                        Video
                    </th>

                    <th class="px-6 py-4 text-left">
                        Tanggal
                    </th>

                    <th class="px-6 py-4 text-center">
                        Komentar
                    </th>

                    <th class="px-6 py-4 text-center">
                        Cyberbullying
                    </th>

                    <th class="px-6 py-4 text-center">
                        Waktu
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($histories as $history)

                <tr class="border-t border-slate-100 hover:bg-slate-50">

                    <td class="px-6 py-4">

                        {{ ($histories->currentPage() - 1) * $histories->perPage() + $loop->iteration }}

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex items-center gap-4">

                            @if($history->thumbnail)

                                <img
                                    src="{{ $history->thumbnail }}"
                                    class="w-20 h-12 rounded-lg object-cover border">

                            @endif

                            <div>

                                <a href="{{ $history->video_url }}"
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-700 hover:underline">

                                    {{ Str::limit($history->video_url, 60) }}

                                </a>

                            </div>

                        </div>

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $history->created_at->format('d M Y') }}

                        <div class="text-xs text-slate-400">

                            {{ $history->created_at->format('H:i') }}

                        </div>

                    </td>

                    <td class="px-6 py-4 text-center">

                        <span class="font-semibold text-slate-800">

                            {{ number_format($history->total_comments) }}

                        </span>

                    </td>

                    <td class="px-6 py-4 text-center">

                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-600 font-medium">

                            {{ number_format($history->cyberbullying_percentage, 2) }}%

                        </span>

                    </td>

                    <td class="px-6 py-4 text-center">

                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-600 font-medium">

                            {{ $history->analysis_time ?? 0 }} s

                        </span>

                    </td>

                    <td class="px-6 py-4 text-center">

                        <a href="{{ route('history.detail', $history->id) }}"
                           class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">

                            Detail

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-16 text-slate-500">

                        Belum ada riwayat analisis.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    @if($histories->hasPages())

    <div class="p-6 border-t border-slate-200">

        {{ $histories->links() }}

    </div>

    @endif

</div>

@endsection
