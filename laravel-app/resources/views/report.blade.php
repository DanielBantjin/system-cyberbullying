@extends('layouts.app')

@section('title', 'Laporan Evaluasi Model')

@section('content')

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Laporan Evaluasi Model
        </h1>

        <p class="text-slate-500 mt-2">
            Hasil evaluasi model IndoBERT untuk klasifikasi komentar YouTube.
        </p>

    </div>

    <!-- METRIK -->
    <div class="grid md:grid-cols-5 gap-6">

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
            <p class="text-slate-500 text-sm">
                Accuracy
            </p>
            <h2 class="text-5xl font-bold text-blue-600 mt-3">
                83.55%
            </h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
            <p class="text-slate-500 text-sm">
                Precision
            </p>
            <h2 class="text-5xl font-bold text-green-600 mt-3">
                87.54%
            </h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
            <p class="text-slate-500 text-sm">
                Recall
            </p>
            <h2 class="text-5xl font-bold text-purple-600 mt-3">
                85.09%
            </h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
            <p class="text-slate-500 text-sm">
                F1 Score
            </p>
            <h2 class="text-5xl font-bold text-orange-500 mt-3">
                86.07%
            </h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
            <p class="text-slate-500 text-sm">
                AUC Score
            </p>
            <h2 class="text-5xl font-bold text-red-500 mt-3">
                95.40%
            </h2>
        </div>

    </div>

    <!-- INFORMASI PENGUJIAN -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Informasi Pengujian Model
        </h2>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="space-y-4">

                <div>
                    Total Dataset :
                    <strong>9.298 Data</strong>
                </div>

                <div>
                    Data Training :
                    <strong>7.438 Data (80%)</strong>
                </div>

                <div>
                    Data Testing :
                    <strong>1.860 Data (20%)</strong>
                </div>

                <div>
                    Metode Split :
                    <strong>Train-Test Split (80:20)</strong>
                </div>

            </div>

            <div class="space-y-4">

                <div>
                    Total Epoch :
                    <strong>4 Epoch</strong>
                </div>

                <div>
                    Model :
                    <strong>IndoBERT</strong>
                </div>

                <div>
                    Jumlah Kelas :
                    <strong>3 Kategori</strong>
                </div>

            </div>

        </div>

    </div>

    <!-- DISTRIBUSI DATASET -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Distribusi Dataset
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-red-50 border border-red-100 p-6 rounded-2xl">

                <p class="text-red-600 font-semibold">
                    Cyberbullying (1)
                </p>

                <h3 class="text-4xl font-bold mt-3 text-red-500">
                    4.649
                </h3>

            </div>

            <div class="bg-green-50 border border-green-100 p-6 rounded-2xl">

                <p class="text-green-600 font-semibold">
                    Non-Bullying (0)
                </p>

                <h3 class="text-4xl font-bold mt-3 text-green-500">
                    3.719
                </h3>

            </div>

            <div class="bg-orange-50 border border-orange-100 p-6 rounded-2xl">

                <p class="text-orange-600 font-semibold">
                    Data Tidak Valid (2)
                </p>

                <h3 class="text-4xl font-bold mt-3 text-orange-500">
                    930
                </h3>

            </div>

        </div>

    </div>

    <!-- HASIL CONFUSION MATRIX -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Hasil Confusion Matrix
        </h2>

        <div class="overflow-x-auto">

            <table class="w-full border border-slate-200">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="p-4 border">
                            Actual / Predicted
                        </th>

                        <th class="p-4 border">
                            Non-Bullying
                        </th>

                        <th class="p-4 border">
                            Cyberbullying
                        </th>

                        <th class="p-4 border">
                            Tidak Valid
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td class="p-4 border font-semibold">
                            Non-Bullying
                        </td>
                        <td class="p-4 border text-center">544</td>
                        <td class="p-4 border text-center">197</td>
                        <td class="p-4 border text-center">3</td>
                    </tr>

                    <tr>
                        <td class="p-4 border font-semibold">
                            Cyberbullying
                        </td>
                        <td class="p-4 border text-center">90</td>
                        <td class="p-4 border text-center">839</td>
                        <td class="p-4 border text-center">1</td>
                    </tr>

                    <tr>
                        <td class="p-4 border font-semibold">
                            Tidak Valid
                        </td>
                        <td class="p-4 border text-center">13</td>
                        <td class="p-4 border text-center">2</td>
                        <td class="p-4 border text-center">171</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <!-- GAMBAR -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Grafik Training Per Epoch
        </h2>

        <img src="{{ asset('images/epoch.png') }}" class="w-full rounded-2xl border">

    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Kurva F1 Score
        </h2>

        <div class="flex justify-center">
            <img src="{{ asset('images/f1curve.png') }}"
                class="max-h-[500px] w-auto rounded-2xl border border-slate-200 shadow-sm">
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Visualisasi Confusion Matrix
        </h2>

        <div class="flex justify-center">
            <img src="{{ asset('images/confusionmetrix.png') }}"
                class="max-h-[500px] w-auto rounded-2xl border border-slate-200 shadow-sm">
        </div>

    </div>

    <!-- RINGKASAN -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mt-8 p-8 mb-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Ringkasan Hasil Evaluasi
        </h2>

        <p class="text-slate-600 leading-8 text-justify">

            Model IndoBERT dilatih menggunakan dataset sebanyak
            <strong>9.298 komentar YouTube</strong> yang terdiri dari
            <strong>4.649 komentar Cyberbullying</strong>,
            <strong>3.719 komentar Non-Bullying</strong>, dan
            <strong>930 komentar Data Tidak Valid</strong>.
            Dataset dibagi menggunakan metode Train-Test Split dengan
            perbandingan 80:20 sehingga diperoleh 7.438 data latih dan
            1.860 data uji.

            <br><br>

            Berdasarkan hasil evaluasi, model memperoleh nilai
            <strong>Accuracy sebesar 83,55%</strong>,
            <strong>Precision sebesar 87,54%</strong>,
            <strong>Recall sebesar 85,09%</strong>,
            <strong>F1-Score sebesar 86,07%</strong>,
            dan <strong>AUC Score sebesar 95,40%</strong>.

            <br><br>

            Hasil confusion matrix menunjukkan bahwa model mampu
            mengklasifikasikan 544 data Non-Bullying,
            839 data Cyberbullying, dan 171 data Tidak Valid
            dengan benar. Kesalahan klasifikasi masih ditemukan terutama
            pada kategori Non-Bullying yang terkadang diprediksi sebagai
            Cyberbullying sebanyak 197 data.

            <br><br>

            Secara keseluruhan, model IndoBERT menunjukkan performa yang baik
            dalam mendeteksi cyberbullying pada komentar YouTube dan layak
            digunakan sebagai pendukung proses moderasi maupun analisis
            komentar secara otomatis.

        </p>

    </div>

@endsection