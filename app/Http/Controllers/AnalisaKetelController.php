<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Analysis;
use App\Models\Material;
use App\Models\Indicator;
use Illuminate\Http\Request;

class AnalisaKetelController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Material::where('station_id', 10)->select('id');
        $samples = Sample::whereIn('material_id', $materials)->orderBy('id', 'desc')->limit(1000)->get();
        $indicators = Indicator::whereIn('id', [10,12,13,14])->get();
        return view('analisa_ketel.index', compact('stations', 'samples', 'indicators'));
    }

    public function store(Request $request)
    {

        $material = Sample::whereId($request->sample_id)->get()->last()->material_id;
        $method = Method::where('material_id', $material)->select('indicator_id')->get();

        foreach($method as $method){
            $indicators[] = $method->indicator_id;
        }

        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 10, 'value' => $request->pH, 'user_id' => Auth()->user()->id]);
        Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 12, 'value' => $request->TDS, 'user_id' => Auth()->user()->id]);

        if(in_array(13, $indicators)){
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 13, 'value' => $request->Sadah, 'user_id' => Auth()->user()->id]);
        }

        if(in_array(14, $indicators)){
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 14, 'value' => $request->P2O5, 'user_id' => Auth()->user()->id]);
        }

        Activity::insert(['subject' => 'Analisa Ketel', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');

    }
}
