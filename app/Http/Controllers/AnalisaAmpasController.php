<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Analysis;
use App\Models\Indicator;
use App\Models\Factor;
use Illuminate\Http\Request;

class AnalisaAmpasController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Method::whereIn('indicator_id', [3,7,8,25])->select('material_id');
        $samples = Sample::whereIn('material_id', $materials)->orderBy('id', 'desc')->limit(1000)->get();
        $indicators = Indicator::whereIn('id', [3,7,8,25])->get();
        return view('analisa_ampas.index', compact('stations', 'samples', 'indicators'));
    }

    public function store(Request $request)
    {
        $material = Sample::whereId($request->sample_id)->get()->last()->material_id;
        $method = Method::where('material_id', $material)->select('indicator_id')->get();

        foreach($method as $method){
            $indicators[] = $method->indicator_id;
        }

        if(in_array(25, $indicators)){
            $factor = Factor::where('name', 'Pol Ampas')->get()->last()->value;
            $pol = Analysis::where('sample_id', $request->sample_id)->where('indicator_id', 3)->get()->last()->value;
            $pol_ampas = (($pol/2) * 0.0286 * ((10000+$request->air)/100)*2.5) + $factor;
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 7, 'value' => $request->air, 'user_id' => Auth()->user()->id]);
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 8, 'value' => $request->zk, 'user_id' => Auth()->user()->id]);
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 25, 'value' => $pol_ampas, 'user_id' => Auth()->user()->id]);
        }
        else {
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 7, 'value' => $request->air, 'user_id' => Auth()->user()->id]);
            Analysis::insert(['sample_id' => $request->sample_id, 'indicator_id' => 8, 'value' => $request->zk, 'user_id' => Auth()->user()->id]);
        }

        Activity::insert(['subject' => 'Analisa Ampas', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function delete(Request $request){
        Analysis::where('sample_id', $request->id)->where('indicator_id', 3)->delete();
        Analysis::where('sample_id', $request->id)->where('indicator_id', 7)->delete();
        Analysis::where('sample_id', $request->id)->where('indicator_id', 8)->delete();
        Analysis::where('sample_id', $request->id)->where('indicator_id', 25)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
