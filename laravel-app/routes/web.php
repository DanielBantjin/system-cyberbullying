<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictController;
use App\Exports\YoutubeCommentsExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::view('/', 'dashboard')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::view('/analysis', 'analysis')
    ->name('analysis');

Route::view('/report', 'report')
    ->name('report');

Route::view('/about', 'about')
    ->name('about');

/*
|--------------------------------------------------------------------------
| RIWAYAT ANALISIS
|--------------------------------------------------------------------------
*/

Route::get('/history', [
    PredictController::class,
    'history'
])->name('history');

Route::get('/history/{id}', [
    PredictController::class,
    'historyDetail'
])->name('history.detail');

/*
|--------------------------------------------------------------------------
| ANALISIS YOUTUBE
|--------------------------------------------------------------------------
*/

Route::post('/predict-youtube', [
    PredictController::class,
    'predictYoutube'
])->name('predict.youtube');

/*
|--------------------------------------------------------------------------
| PROGRESS ANALISIS
|--------------------------------------------------------------------------
*/

Route::get('/youtube/progress/{jobId}', [
    PredictController::class,
    'progress'
])->name('predict.progress');

/*
|--------------------------------------------------------------------------
| HASIL ANALISIS
|--------------------------------------------------------------------------
*/

Route::get('/youtube/result/{jobId}', [
    PredictController::class,
    'result'
])->name('predict.result');

/*
|--------------------------------------------------------------------------
| EXPORT EXCEL
|--------------------------------------------------------------------------
*/

Route::get('/export-excel', function () {

    return Excel::download(
        new YoutubeCommentsExport,
        'hasil_analisis.xlsx'
    );

})->name('export.excel');

