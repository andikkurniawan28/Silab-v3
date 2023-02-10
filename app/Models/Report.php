<?php

namespace App\Models;

use App\Models\Sample;
use App\Models\Balance;
use App\Models\Posbrix;
use App\Models\Analysis;
use App\Models\Material;
use App\Models\Imbibition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    public function serve($request)
    {
        $time = self::determineTimeRange($request);
        foreach(Material::all() as $material)
        {
            $data[$material->id]['material'] = $material->name;

            $data[$material->id]['sample'] =
                Sample::where('created_at', '>=', $time['current'])
                ->where('created_at', '<', $time['tomorrow'])
                ->where('material_id', $material->id)
                ->select('id')
                ->get();

            foreach(Method::where('material_id', $material->id)->get() as $method) {
                $data[$material->id][$method->indicator->name] =
                    Analysis::where('indicator_id', $method->indicator_id)
                        ->whereIn('sample_id', $data[$material->id]['sample'])
                        ->avg('value');
            }
        }
        return $data;
    }

    public function serveKeliling($request){
        $time = self::determineTimeRange($request);
        $kspots = Kspot::all();
        foreach($kspots as $kspot){
            $data[$kspot->id]['name'] = $kspot->name;
            $data[$kspot->id]['average'] = Kvalue::where('kspot_id', $kspot->id)
                ->where('created_at', '>=', $time['current'])
                ->where('created_at', '<', $time['tomorrow'])
                ->avg('value');
        }
        return $data;
    }

    public function serveChemical($request){
        $time = self::determineTimeRange($request);
        $chemicals = Chemical::all();
        foreach($chemicals as $chemical){
            $data[$chemical->id]['name'] = $chemical->name;
            $data[$chemical->id]['sum'] = Chemicalvalue::where('chemical_id', $chemical->id)
                ->where('created_at', '>=', $time['current'])
                ->where('created_at', '<', $time['tomorrow'])
                ->sum('value');
        }
        return $data;
    }

    public function serveBalance($request){
        $time = self::determineTimeRange($request);

        $data['tebu'] = Balance::where('created_at', '>=', $time['current'])
            ->where('created_at', '<', $time['tomorrow'])
            ->sum('tebu');

        $data['flow_nm'] = Balance::where('created_at', '>=', $time['current'])
            ->where('created_at', '<', $time['tomorrow'])
            ->sum('flow_nm');

        $data['flow_imb'] = Imbibition::where('created_at', '>=', $time['current'])
            ->where('created_at', '<', $time['tomorrow'])
            ->sum('flow_imb');

        return $data;
    }

    public function servePosBrix($request){
        $time = self::determineTimeRange($request);
        $data['ek'] = Posbrix::where('created_at', '>=', $time['current'])
            ->where('created_at', '<', $time['tomorrow'])
            ->avg('brix');
        $data['eb'] = Posbrix::where('created_at', '>=', $time['current'])
            ->where('created_at', '<', $time['tomorrow'])
            ->avg('brix');
        return $data;
    }

    public function determineTimeRange($request)
    {
        switch($request->shift)
        {
            case 0 :
                $data['current'] = $request->date.' 05:00';
                $data['tomorrow'] = date('Y-m-d H:i', strtotime($data['current'] . "+24 hours"));
            break;
            case 1 :
                $data['current'] = $request->date.' 05:00';
                $data['tomorrow'] = date('Y-m-d H:i', strtotime($data['current'] . "+8 hours"));
            break;
            case 2 :
                $data['current'] = $request->date.' 13:00';
                $data['tomorrow'] = date('Y-m-d H:i', strtotime($data['current'] . "+8 hours"));
            break;
            case 3 :
                $data['current'] = $request->date.' 21:00';
                $data['tomorrow'] = date('Y-m-d H:i', strtotime($data['current'] . "+8 hours"));
            break;
        }
        return $data;
    }
}
