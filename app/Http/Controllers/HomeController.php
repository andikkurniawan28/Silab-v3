<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Station;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $stations = Station::all();
        $data['npp'] = self::serveData(3, '%R');
        $data['rs'] = self::serveData(2, 'IU');
        $data['ampas'] = self::serveData(12, 'Pol Ampas');
        $data['shs'] = self::serveData(67, 'IU');
        return view('home.index', compact('stations', 'data'));
    }

    public function serveData($material_id, $indicator){
        $sample = Sample::where('material_id', $material_id);
        if($sample->count() > 0){
            $analysis_sample = $sample->get()->last()->analysis;
            foreach($analysis_sample as $analysis)
            {
                if($analysis->indicator->name == $indicator){
                    $data = $analysis->value;
                }
            }
        }
        else $data = NULL;
        return $data;
    }
}
