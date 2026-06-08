@extends('layouts.app')

@section('title', 'Beranda')
@section('page-title', 'Beranda')

@section('content')

    <div class="max-w-6xl mx-auto">

        <!-- CARD UTAMA -->
        <div class="bg-white rounded-[32px] overflow-hidden border border-slate-200 shadow-sm">

            <div class="bg-gradient-to-r from-blue-600 via-sky-500 to-cyan-400 p-12 text-white">

                <h1 class="text-5xl font-bold leading-tight">
                    Sistem Analisis Cyberbullying
                </h1>

                <p class="mt-5 text-lg text-blue-100 max-w-3xl leading-8">

                    Sistem ini dirancang untuk menganalisis komentar YouTube
                    dan mendeteksi adanya potensi cyberbullying dengan menggunakan
                    teknologi machine learning.

                </p>

                <a href="{{ route('analysis') }}"
                    class="inline-flex items-center mt-8 px-8 py-4 bg-white text-blue-600 font-semibold rounded-2xl hover:shadow-lg transition-all duration-300">

                    Mulai Analisis

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                    </svg>

                </a>

            </div>

            <div class="p-10">

                <h2 class="text-2xl font-semibold text-slate-800">
                    Tentang Sistem
                </h2>

                <p class="mt-5 text-slate-600 leading-8">

                    Sistem Deteksi Cyberbullying pada Komentar YouTube merupakan aplikasi berbasis web yang memanfaatkan
                    model IndoBERT untuk mendeteksi dan mengklasifikasikan komentar berbahasa Indonesia pada platform
                    YouTube. Sistem dapat menganalisis komentar secara otomatis dengan mengelompokkannya ke dalam kategori
                    Cyberbullying, Non-Cyberbullying, dan Tidak Valid. Selain menampilkan hasil klasifikasi setiap komentar,
                    sistem juga menyediakan visualisasi statistik dan ringkasan hasil analisis untuk membantu pengguna
                    memahami tingkat penyebaran cyberbullying pada suatu video. Dengan adanya sistem ini, diharapkan proses
                    pemantauan konten dan identifikasi perilaku cyberbullying di media sosial dapat dilakukan secara lebih
                    cepat, efektif, dan akurat.


                </p>

            </div>

        </div>

@endsection