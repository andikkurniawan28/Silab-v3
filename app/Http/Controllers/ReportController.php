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
        return view('report.show', compact('data', 'indicators', 'request'));
    }
}
