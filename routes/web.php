<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\SampleResultController;
use App\Http\Controllers\StationResultController;
use App\Http\Controllers\MonitoringAnalisaPerTanggalController;

Route::get('/', HomeController::class)->name('home')->middleware(['auth']);
Route::resource('samples', SampleController::class);
Route::resource('analyses', AnalysisController::class);
Route::get('station_result/{station_id}', StationResultController::class)->name('station_result');
Route::get('sample_result/{material_id}', SampleResultController::class)->name('sample_result');
Route::get('report', [ ReportController::class, 'index' ])->name('report');
Route::post('report_process', [ ReportController::class, 'process' ])->name('report_process');
Route::get('login', [ LoginController::class, 'index' ])->name('login');
Route::post('login_process', [ LoginController::class, 'process' ])->name('login_process');
Route::get('logout', LogoutController::class)->name('logout');
Route::get('monitoring_analisa_per_tanggal', [ MonitoringAnalisaPerTanggalController::class, 'index'])->name('monitoring_analisa_per_tanggal')->middleware(['auth']);
Route::post('monitoring_analisa_per_tanggal_process', [ MonitoringAnalisaPerTanggalController::class, 'process'])->name('monitoring_analisa_per_tanggal_process')->middleware(['auth']);
