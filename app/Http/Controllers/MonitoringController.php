<?php

namespace App\Http\Controllers;

use App\Models\Ari;
use App\Models\Score;
use App\Models\Method;
use App\Models\Sample;
use App\Models\Balance;
use App\Models\Posbrix;
use App\Models\Station;
use App\Models\Material;
use App\Models\Kactivity;
use App\Models\Imbibition;
use App\Models\Chemicalchecking;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function __invoke(Request $request)
    {
        $time = date('Y-m-d 5:00', strtotime(session('date')));

        if ($request->session()->missing('date')) {
            return redirect()->route('monitoring_select_date')->with('error', 'Silahkan pilih tanggal!');
        }
        else {

            $min_time = date('Y-m-d 5:00', strtotime(session('date')));
            $max_time = date('Y-m-d H:i', strtotime($min_time . "+24 hours"));

            $stations = Station::all();

            foreach($stations as $station){
                $material[$station->id] = Material::where('station_id', $station->id)->get();
                foreach($material[$station->id] as $materialx){
                    $materialx->sample = Sample::where('material_id', $materialx->id)
                        ->where('created_at', '>=', $min_time)
                        ->where('created_at', '<', $max_time)
                        ->orderBy('id', 'desc')
                        ->get();
                    $materialx->method = Method::where('material_id', $materialx->id)->get();
                }
            }

            $kactivities = Kactivity::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            $chemicalcheckings = Chemicalchecking::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            $balances = Balance::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            $imbibitions = Imbibition::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            $posbrixes = Posbrix::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            $aris = Ari::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            $scores = Score::where('created_at', '>=', $min_time)
                ->where('created_at', '<', $max_time)
                ->orderBy('id', 'desc')
                ->get();

            return view('monitoring.index', compact(
                'stations', 'material', 'kactivities', 'chemicalcheckings', 'balances', 'imbibitions',
                'posbrixes', 'aris', 'scores')
            );
        }
    }
}
