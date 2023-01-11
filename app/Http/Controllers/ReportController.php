<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function process(Request $request)
    {
        $data = Report::serve($request->date);
        return view('report.show', compact('data'));
        // return $data;
    }
}
