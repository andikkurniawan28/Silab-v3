<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Material;
use App\Models\Indicator;
use Illuminate\Http\Request;

class StationResultController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($station_id)
    {
        $materials = Material::where('station_id', $station_id)->get();
        return view('station_result.index', compact('materials'));
    }
}
