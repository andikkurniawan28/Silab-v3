<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Indicator;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function process(Request $request)
    {
        $indicators = Indicator::all();
        $data = Report::serve($request);
        return view('report.show', compact('data', 'indicators'));
    }
}
