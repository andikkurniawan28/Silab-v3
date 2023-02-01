<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Analysis;
use App\Models\Indicator;
use Illuminate\Http\Request;

class SaccharomatController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Method::where('indicator_id', '<=', 5)->select('material_id');
        $samples = Sample::whereIn('material_id', $materials)->orderBy('id', 'desc')->limit(1000)->get();
        $indicators = Indicator::whereIn('id', [1,2,3,4,5])->get();
        return view('saccharomat.index', compact('stations', 'samples', 'indicators'));
    }

    public function store(Request $request)
    {
        $material = Sample::whereId($request->sample_id)->get()->last()->material_id;
        $method = Method::where('material_id', $material)->select('indicator_id')->get();

        foreach($method as $method){
            $indicators[] = $method->indicator_id;
        }

        // SO2 maka sample ini Gula
        if(in_array(15, $indicators)){

            $kadar_air = Analysis::where('sample_id', $request->sample_id)->where('indicator_id', 7)->get()->last()->value;
            $data[1] = 100 - $kadar_air;
            $data[4] = self::findPurity($request);
            $data[2] = $data[4] * $data[1] / 100;
            $data[3] = $request->pol;

            for($i=1; $i<=4; $i++){
                Analysis::insert(['sample_id' => $request->sample_id, 'user_id' => Auth()->user()->id, 'indicator_id' => $i, 'value' => $data[$i]]);
            }
            return redirect()->back()->with('success', 'Data berhasil disimpan');

        }
        // Jika tidak ada bukan Gula
        else {

            $data[1] = $request->pbrix;
            $data[2] = $request->ppol;
            $data[3] = $request->pol;
            $data[4] = self::findPurity($request);

            for($i=1; $i<=4; $i++){
                Analysis::insert(['sample_id' => $request->sample_id, 'user_id' => Auth()->user()->id, 'indicator_id' => $i, 'value' => $data[$i]]);
            }

            if(in_array(5, $indicators)){
                $data[5] = self::findYield($request);
                Analysis::insert(['sample_id' => $request->sample_id, 'user_id' => Auth()->user()->id, 'indicator_id' => 5, 'value' => $data[5]]);
            }

            Activity::insert(['subject' => 'Saccharomat', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
            return redirect()->back()->with('success', 'Data berhasil disimpan');

        }

        return $data;
    }

    public function findPurity($request){
        $faktor = Factor::where('name', 'Saccharomat')->get()->last()->value;
        return (($request->ppol / $request->pbrix) * 100) + ($faktor * $request->pbrix);
    }

    public function findYield($request){
        $faktor_rendemen = Factor::where('name', 'Rendemen')->get()->last()->value;
        $faktor_mellase = Factor::where('name', 'Mollases')->get()->last()->value;
        return $faktor_rendemen * ($request->ppol - $faktor_mellase * ($request->pbrix - $request->ppol));
    }
}
