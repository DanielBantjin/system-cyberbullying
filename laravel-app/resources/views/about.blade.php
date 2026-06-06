@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<!-- HEADER -->

<div class="mb-10">

    <h1 class="text-3xl font-bold text-slate-800">
        Tentang Tim Peneliti
    </h1>

    <p class="text-slate-500 mt-2">
        Tim pengembang Sistem Deteksi Cyberbullying pada Komentar YouTube
        menggunakan model IndoBERT.
    </p>

</div>

<!-- DOSEN PEMBIMBING -->

<div
    class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl shadow-lg p-8 mb-10 text-white">

    <div class="flex flex-col lg:flex-row items-center gap-10">

        <!-- FOTO DOSEN -->

        <div
            class="w-60 h-72 flex-shrink-0 flex items-center justify-center bg-white rounded-3xl p-3 shadow-xl">

            <img
                src="{{ asset('images/dosen.jpg') }}"
                alt="Dosen Pembimbing"
                class="max-w-full max-h-full object-contain rounded-2xl">

        </div>

        <!-- DATA DOSEN -->

        <div class="flex-1">

            <span
                class="inline-block px-4 py-2 bg-white/20 rounded-full text-sm">

                Dosen Pembimbing

            </span>

            <h2 class="text-4xl font-bold mt-4">

                Hendra Handoko Syahputra Pasaribu, S.Kom., M.Kom.

            </h2>

            <p class="text-blue-100 mt-3 text-lg">

                Program Studi Teknik Informatika

            </p>

            <div class="grid md:grid-cols-2 gap-4 mt-8">

                <div>

                    <strong>Jabatan :</strong>
                    Dosen Pembimbing Penelitian

                </div>

                <div>

                    <strong>Universitas :</strong>
                    Universitas Prima Indonesia

                </div>

            </div>


        </div>

    </div>

</div>

<!-- TIM PENELITI -->

<div class="mb-6">

    <h2 class="text-2xl font-bold text-slate-800">
        Tim Peneliti
    </h2>

    <p class="text-slate-500 mt-2">
        Mahasiswa Universitas Prima Indonesia yang terlibat
        dalam penelitian.
    </p>

</div>

<div class="grid lg:grid-cols-2 gap-8">

    <!-- DANIEL -->

    <div
        class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition">

        <div class="flex flex-col md:flex-row gap-6 items-center">

            <div
                class="w-40 h-48 flex-shrink-0 flex items-center justify-center bg-slate-50 rounded-2xl border border-slate-200">

                <img
                    src="{{ asset('images/daniel.jpg') }}"
                    alt="Daniel"
                    class="max-w-full max-h-full object-contain rounded-2xl">

            </div>

            <div class="flex-1">

                <h3 class="text-xl font-bold text-slate-800">
                    Daniel Septian Feri Bancin
                </h3>

                 <span
                    class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">

                    Anggota Peneliti

                </span>

                <div class="mt-4 space-y-2 text-slate-600">

                    <p><strong>NIM :</strong> 223303030288</p>
                    <p><strong>TTL :</strong> Medan, 13 September 2003</p>
                    <p><strong>Email :</strong> danielseptianveribancin@gmail.com</p>
                    <p><strong>Universitas :</strong> Universitas Prima Indonesia</p>

                </div>

            </div>

        </div>

    </div>

    <!-- DIAN -->

    <div
        class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition">

        <div class="flex flex-col md:flex-row gap-6 items-center">

            <div
                class="w-40 h-48 flex-shrink-0 flex items-center justify-center bg-slate-50 rounded-2xl border border-slate-200">

                <img
                    src="{{ asset('images/dian.jpeg') }}"
                    alt="Dian"
                    class="max-w-full max-h-full object-contain rounded-2xl">

            </div>

            <div class="flex-1">

                <h3 class="text-xl font-bold text-slate-800">
                    Dian Karina Sembiring
                </h3>

                <span
                    class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">

                    Anggota Peneliti

                </span>

                <div class="mt-4 space-y-2 text-slate-600">

                    <p><strong>NIM :</strong> 223303030294</p>
                    <p><strong>TTL :</strong> Medan, 24 November 2004</p>
                    <p><strong>Email :</strong> diankarinasembiring@gmail.com</p>
                    <p><strong>Universitas :</strong> Universitas Prima Indonesia</p>

                </div>

            </div>

        </div>

    </div>

    <!-- VRENDY -->

    <div
        class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition">

        <div class="flex flex-col md:flex-row gap-6 items-center">

            <div
                class="w-40 h-48 flex-shrink-0 flex items-center justify-center bg-slate-50 rounded-2xl border border-slate-200">

                <img
                    src="{{ asset('images/vrendy.png') }}"
                    alt="Vrendy"
                    class="max-w-full max-h-full object-contain rounded-2xl">

            </div>

            <div class="flex-1">

                <h3 class="text-xl font-bold text-slate-800">
                    Vrendy Gusman Gulo
                </h3>

                <span
                    class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">

                    Anggota Peneliti

                </span>

                <div class="mt-4 space-y-2 text-slate-600">

                    <p><strong>NIM :</strong> 223303030300</p>
                    <p><strong>TTL :</strong> Hiliwase, 29 Agustus 2004</p>
                    <p><strong>Email :</strong> vrendygusmangulo@gmail.com</p>
                    <p><strong>Universitas :</strong> Universitas Prima Indonesia</p>

                </div>

            </div>

        </div>

    </div>

    <!-- JOYAKIM -->

    <div
        class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-lg transition">

        <div class="flex flex-col md:flex-row gap-6 items-center">

            <div
                class="w-40 h-48 flex-shrink-0 flex items-center justify-center bg-slate-50 rounded-2xl border border-slate-200">

                <img
                    src="{{ asset('images/joyakim.png') }}"
                    alt="Joyakim"
                    class="max-w-full max-h-full object-contain rounded-2xl">

            </div>

            <div class="flex-1">

                <h3 class="text-xl font-bold text-slate-800">
                    Joyakim Simarmata
                </h3>

                <span
                    class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">

                    Anggota Peneliti

                </span>

                <div class="mt-4 space-y-2 text-slate-600">

                    <p><strong>NIM :</strong> 223303030280</p>
                    <p><strong>TTL :</strong> Samosir, 2 Desember 2003</p>
                    <p><strong>Email :</strong> joyakimsimarmata.0101@gmail.com</p>
                    <p><strong>Universitas :</strong> Universitas Prima Indonesia</p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection