<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Analysis;
use App\Models\Indicator;
use Illuminate\Http\Request;

class AnalisaUmumController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Method::whereIn('indicator_id', [9,10,11])->select('material_id');
        $samples = Sample::whereIn('material_id', $materials)->orderBy('id', 'desc')->limit(1000)->get();
        $indicators = Indicator::whereIn('id', [9,10,11])->get();
        return view('analisa_umum.index', compact('stations', 'samples', 'indicators'));
    }

    public function store(Request $request)
    {
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 9, 'value' => $request->CaO, 'user_id' => Auth()->user()->id]);
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 10, 'value' => $request->pH, 'user_id' => Auth()->user()->id]);
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 11, 'value' => $request->Turb, 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
