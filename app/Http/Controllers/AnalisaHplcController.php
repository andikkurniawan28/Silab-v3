<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Analysis;
use App\Models\Indicator;
use Illuminate\Http\Request;

class AnalisaHplcController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Method::whereIn('indicator_id', [18,19,20])->select('material_id');
        $samples = Sample::whereIn('material_id', $materials)->orderBy('id', 'desc')->limit(1000)->get();
        $indicators = Indicator::whereIn('id', [18,19,20])->get();
        return view('analisa_hplc.index', compact('stations', 'samples', 'indicators'));
    }

    public function store(Request $request)
    {
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 18, 'value' => $request->Succ, 'user_id' => Auth()->user()->id]);
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 19, 'value' => $request->Gluc, 'user_id' => Auth()->user()->id]);
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 20, 'value' => $request->Fruc, 'user_id' => Auth()->user()->id]);
        Activity::insert(['subject' => 'Analisa Hplc', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function delete(Request $request){
        Analysis::where('sample_id', $request->id)->where('indicator_id', 18)->delete();
        Analysis::where('sample_id', $request->id)->where('indicator_id', 19)->delete();
        Analysis::where('sample_id', $request->id)->where('indicator_id', 20)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
