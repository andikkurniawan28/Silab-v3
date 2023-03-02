<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Material;
use Illuminate\Http\Request;

class SampleResultController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($material_id)
    {
        $stations = Station::all();
        $material = Material::whereId($material_id)->get()->last()->name;
        $samples = Sample::where('material_id', $material_id)->latest()->paginate(5000);
        $methods = Method::where('material_id', $material_id)->get();
        return view('sample_result.index', compact('material', 'samples', 'methods', 'stations', 'material_id'));
    }
}
