<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Station;
use App\Models\Indicator;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        return view('report.index', compact('stations'));
    }

    public function process(Request $request)
    {
        $indicators = Indicator::all();
        $data = Report::serve($request);
        $keliling = Report::serveKeliling($request);
        $chemical = Report::serveChemical($request);
        $balance = Report::serveBalance($request);
        $posbrix = Report::servePosBrix($request);
        $ari = Report::serveAri($request);
        $kud = Report::serveKud($request);
        $pospantau = Report::servePospantau($request);
        $wilayah = Report::serveWilayah($request);
        $timbangan = Report::serveTimbangan($request);
        return view('report.show', compact('data', 'indicators', 'request', 'keliling', 'chemical', 'balance', 'posbrix', 'ari', 'kud', 'pospantau', 'wilayah', 'timbangan'));
    }
}
