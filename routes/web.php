<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\SampleResultController;
use App\Http\Controllers\StationResultController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('samples', SampleController::class);
Route::resource('analyses', AnalysisController::class);
Route::get('station_result/{station_id}', StationResultController::class)->name('station_result');
Route::get('sample_result/{material_id}', SampleResultController::class)->name('sample_result');
