<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AriController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\KudController;
use App\Http\Controllers\RitController;
use App\Http\Controllers\DirtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkmtController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KspotController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\TspotController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\KvalueController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\TvalueController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\MollaseController;
use App\Http\Controllers\PosbrixController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\ChemicalController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AnalisaPenilaianMbs;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\KactivityController;
use App\Http\Controllers\PospantauController;
use App\Http\Controllers\TactivityController;
use App\Http\Controllers\ImbibitionController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\AnalisaHplcController;
use App\Http\Controllers\AnalisaUmumController;
use App\Http\Controllers\AriSamplingController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CetakRonselController;
use App\Http\Controllers\PosbrixRfidController;
use App\Http\Controllers\SaccharomatController;
use App\Http\Controllers\AnalisaAmpasController;
use App\Http\Controllers\AnalisaKetelController;
use App\Http\Controllers\CetakBarcodeController;
use App\Http\Controllers\SampleResultController;
use App\Http\Controllers\ScoringValueController;
use App\Http\Controllers\RawsugarinputController;
use App\Http\Controllers\StationResultController;
use App\Http\Controllers\AnalisaPosBrixController;
use App\Http\Controllers\RawsugaroutputController;
use App\Http\Controllers\ScanRfidPosbrixController;
use App\Http\Controllers\ChemicalcheckingController;
use App\Http\Controllers\ScanRfidPosbrixEbControlle;
use App\Http\Controllers\AplikasiPosBrixEbController;
use App\Http\Controllers\AplikasiPosBrixEkController;
use App\Http\Controllers\AplikasiPenerimaanController;
use App\Http\Controllers\CertificateContentController;
use App\Http\Controllers\MonitoringSaveDateController;
use App\Http\Controllers\AplikasiTapSampleAriController;
use App\Http\Controllers\AplikasiTapTimbanganController;
use App\Http\Controllers\MonitoringSelectDateController;
use App\Http\Controllers\AplikasiTapSampleAriEbController;
use App\Http\Controllers\AplikasiTapTimbanganEbController;

Route::get('/', HomeController::class)->name('home')->middleware(['auth']);
Route::resource('stations', StationController::class)->middleware(['auth', 'kasie']);
Route::resource('indicators', IndicatorController::class)->middleware(['auth', 'kasie']);
Route::resource('factors', FactorController::class)->middleware(['auth', 'kasie']);
Route::resource('materials', MaterialController::class)->middleware(['auth', 'mandor']);
Route::resource('samples', SampleController::class)->middleware(['auth', 'operator_qc']);
Route::resource('methods', MethodController::class)->middleware(['auth', 'mandor']);
Route::resource('analyses', AnalysisController::class)->middleware(['auth', 'operator_qc']);
Route::resource('users', UserController::class)->middleware(['auth', 'it']);
Route::resource('balances', BalanceController::class)->middleware(['auth', 'operator_qc']);
Route::resource('imbibitions', ImbibitionController::class)->middleware(['auth', 'operator_non_qc']);
Route::resource('kspots', KspotController::class)->middleware(['auth', 'kasie']);
Route::resource('kactivities', KactivityController::class)->middleware(['auth', 'operator_qc']);
Route::resource('kvalue', KvalueController::class)->middleware(['auth', 'operator_qc']);
Route::resource('tspots', TspotController::class)->middleware(['auth', 'kasie']);
Route::resource('tactivities', TactivityController::class)->middleware(['auth', 'operator_non_qc']);
Route::resource('tvalue', TvalueController::class)->middleware(['auth', 'operator_non_qc']);
Route::resource('chemicals', ChemicalController::class)->middleware(['auth', 'kasubsie']);
Route::resource('chemicalcheckings', ChemicalcheckingController::class)->middleware(['auth', 'mandor']);
Route::resource('rits', RitController::class)->middleware(['auth', 'operator_qc']);
Route::resource('posbrixes', PosbrixController::class)->middleware(['auth', 'operator_qc']);
Route::resource('aris', AriController::class)->middleware(['auth', 'operator_qc']);
Route::resource('ari_samplings', AriSamplingController::class)->middleware(['auth', 'operator_qc']);
Route::resource('scores', ScoreController::class)->middleware(['auth', 'operator_qc']);
Route::resource('dirts', DirtController::class)->middleware(['auth', 'kasubsie']);
Route::resource('scoring_values', ScoringValueController::class)->middleware(['auth', 'operator_qc']);
Route::get('station_result/{station_id}', StationResultController::class)->name('station_result')->middleware(['auth']);
Route::get('sample_result/{material_id}', SampleResultController::class)->name('sample_result')->middleware(['auth']);
Route::get('report', [ ReportController::class, 'index' ])->name('report')->middleware(['auth', 'mandor']);
Route::post('report_process', [ ReportController::class, 'process' ])->name('report_process')->middleware(['auth', 'mandor']);
Route::get('login', [ LoginController::class, 'index' ])->name('login');
Route::post('login_process', [ LoginController::class, 'process' ])->name('login_process');
Route::get('logout', LogoutController::class)->name('logout');
Route::get('activities', ActivityController::class)->name('activities')->middleware(['auth', 'kabag']);
Route::get('saccharomat', [SaccharomatController::class, 'index'])->name('saccharomat')->middleware(['auth', 'operator_qc']);
Route::get('analisa_ampas', [AnalisaAmpasController::class, 'index'])->name('analisa_ampas')->middleware(['auth', 'operator_qc']);
Route::get('analisa_umum', [AnalisaUmumController::class, 'index'])->name('analisa_umum')->middleware(['auth', 'operator_qc']);
Route::get('analisa_ketel', [AnalisaKetelController::class, 'index'])->name('analisa_ketel')->middleware(['auth', 'operator_qc']);
Route::get('analisa_hplc', [AnalisaHplcController::class, 'index'])->name('analisa_hplc')->middleware(['auth', 'operator_qc']);
Route::get('cetak_barcode', [CetakBarcodeController::class, 'index'])->name('cetak_barcode')->middleware(['auth', 'operator_qc']);
Route::get('cetak_ronsel', [CetakRonselController::class, 'index'])->name('cetak_ronsel')->middleware(['auth', 'operator_non_qc']);
Route::post('saccharomat_store', [SaccharomatController::class, 'store'])->name('saccharomat_store')->middleware(['auth', 'operator_qc']);
Route::post('saccharomat_delete', [SaccharomatController::class, 'delete'])->name('saccharomat_delete')->middleware(['auth', 'operator_qc']);
Route::post('analisa_ampas_store', [AnalisaAmpasController::class, 'store'])->name('analisa_ampas_store')->middleware(['auth', 'operator_qc']);
Route::post('analisa_ampas_delete', [AnalisaAmpasController::class, 'delete'])->name('analisa_ampas_delete')->middleware(['auth', 'operator_qc']);
Route::post('analisa_umum_delete', [AnalisaUmumController::class, 'delete'])->name('analisa_umum_delete')->middleware(['auth', 'operator_qc']);
Route::post('analisa_umum_store', [AnalisaUmumController::class, 'store'])->name('analisa_umum_store')->middleware(['auth', 'operator_qc']);
Route::post('analisa_ketel_store', [AnalisaKetelController::class, 'store'])->name('analisa_ketel_store')->middleware(['auth', 'operator_qc']);
Route::post('analisa_ketel_delete', [AnalisaKetelController::class, 'delete'])->name('analisa_ketel_delete')->middleware(['auth', 'operator_qc']);
Route::post('analisa_hplc_store', [AnalisaHplcController::class, 'store'])->name('analisa_hplc_store')->middleware(['auth', 'operator_qc']);
Route::post('analisa_hplc_delete', [AnalisaHplcController::class, 'delete'])->name('analisa_hplc_delete')->middleware(['auth', 'operator_qc']);
Route::post('cetak_barcode_store', [CetakBarcodeController::class, 'store'])->name('cetak_barcode_store')->middleware(['auth', 'operator_qc']);
Route::post('cetak_ronsel_store', [CetakRonselController::class, 'store'])->name('cetak_ronsel_store')->middleware(['auth', 'operator_non_qc']);
Route::get('monitoring', MonitoringController::class)->name('monitoring')->middleware(['auth']);
Route::get('monitoring_select_date', MonitoringSelectDateController::class)->name('monitoring_select_date')->middleware(['auth']);
Route::post('monitoring_save_date', MonitoringSaveDateController::class)->name('monitoring_save_date')->middleware(['auth']);
Route::get('rit', AplikasiPenerimaanController::class)->name('rit')->middleware(['auth', 'koordinator']);
Route::get('score', AnalisaPenilaianMbs::class)->name('score')->middleware(['auth', 'koordinator']);

// Aplikasi Posbrix
Route::get('posbrix/{spta}/{category}', AnalisaPosBrixController::class)->name('posbrix')->middleware(['auth', 'operator_qc']);
Route::get('scan_rfid', ScanRfidPosbrixController::class)->name('scan_rfid')->middleware(['auth', 'operator_qc']);
Route::get('scan_rfid_eb', ScanRfidPosbrixEbControlle::class)->name('scan_rfid_eb')->middleware(['auth', 'operator_qc']);
Route::post('process_rfid', PosbrixRfidController::class)->name('process_rfid')->middleware(['auth', 'operator_qc']);
Route::post('process_rfid_eb', PosbrixRfidController::class)->name('process_rfid_eb')->middleware(['auth', 'operator_qc']);
Route::post('process_posbrix_ek', AplikasiPosBrixEkController::class)->name('process_posbrix_ek')->middleware(['auth', 'operator_qc']);
Route::post('process_posbrix_eb', AplikasiPosBrixEbController::class)->name('process_posbrix_eb')->middleware(['auth', 'operator_qc']);

// Aplikasi Tap Timbangan
Route::get('tap_timbangan', [AplikasiTapTimbanganController::class, 'index'])->name('tap_timbangan')->middleware(['auth', 'operator_qc']);
Route::get('tap_timbangan_eb', [AplikasiTapTimbanganEbController::class, 'index'])->name('tap_timbangan_eb')->middleware(['auth', 'operator_qc']);
Route::post('tap_timbangan_process', [AplikasiTapTimbanganController::class, 'process'])->name('tap_timbangan_process')->middleware(['auth', 'operator_qc']);
Route::post('tap_timbangan_eb_process', [AplikasiTapTimbanganEbController::class, 'process'])->name('tap_timbangan_eb_process')->middleware(['auth', 'operator_qc']);

// Aplikasi Tap Sample Ari
Route::get('tap_sample_ari', [AplikasiTapSampleAriController::class, 'index'])->name('tap_sample_ari')->middleware(['auth', 'operator_qc']);
Route::get('tap_sample_ari_eb', [AplikasiTapSampleAriEbController::class, 'index'])->name('tap_sample_ari_eb')->middleware(['auth', 'operator_qc']);
Route::post('tap_sample_ari_process', [AplikasiTapSampleAriController::class, 'process'])->name('tap_sample_ari_process')->middleware(['auth', 'operator_qc']);
Route::post('tap_sample_ari_eb_process', [AplikasiTapSampleAriEbController::class, 'process'])->name('tap_sample_ari_eb_process')->middleware(['auth', 'operator_qc']);

// Aplikasi SKMT
Route::get('skmt/{id}', SkmtController::class)->name('skmt')->middleware(['auth', 'operator_qc']);

// Certificate
Route::resource('certificates', CertificateController::class)->middleware(['auth', 'kasubsie']);
Route::resource('certificate_contents', CertificateContentController::class)->middleware(['auth', 'pic']);
Route::resource('coas', CoaController::class)->middleware(['auth', 'pic']);

// Timbangan
Route::resource('mollases', MollaseController::class)->middleware(['auth', 'koordinator']);
Route::resource('rawsugarinputs', RawsugarinputController::class)->middleware(['auth', 'koordinator']);
Route::resource('rawsugaroutputs', RawsugaroutputController::class)->middleware(['auth', 'koordinator']);

// Wilayah
Route::resource('kuds', KudController::class)->middleware(['auth', 'kasubsie']);
Route::resource('pospantaus', PospantauController::class)->middleware(['auth', 'kasubsie']);
Route::resource('wilayahs', WilayahController::class)->middleware(['auth', 'kasubsie']);

