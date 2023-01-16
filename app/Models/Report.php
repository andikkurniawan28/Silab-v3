<?php

namespace App\Models;

use App\Models\Sample;
use App\Models\Analysis;
use App\Models\Material;
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
