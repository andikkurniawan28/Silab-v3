<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function countRawJuice($request)
    {
        $count = self::count();
        if($count != 0)
        {
            $totalizer_latest = self::get()->last()->totalizer;
            $flow_nm = self::findFlow($totalizer_latest, $request->totalizer);
            $nm_persen_tebu = self::findFlowPercentSugarCane($flow_nm, $request->tebu);
        }
        else
        {
            $flow_nm = 0;
            $nm_persen_tebu = 0;
        }
        return $data = [
            'flow_nm' => $flow_nm,
            'nm_persen_tebu' => $nm_persen_tebu,
        ];
    }

    // public static function editRawJuice($request, $id)
    // {
    //     $totalizer_raw_juice_latest = self::where('id', '<', $id)->get()->last()->totalizer_raw_juice;
    //     $flow_raw_juice = self::findFlow($totalizer_raw_juice_latest, $request->totalizer_raw_juice);
    //     $raw_juice_percent_sugar_cane = self::findFlowPercentSugarCane($flow_raw_juice, $request->sugar_cane);
    //     return $data = [
    //         'flow_raw_juice' => $flow_raw_juice,
    //         'raw_juice_percent_sugar_cane' => $raw_juice_percent_sugar_cane,
    //     ];
    // }

    public static function findFlow($totalizer_old, $totalizer_new)
    {
        // $factor = Factor::findRawJuiceFactor();
        $factor = 0.85;
        return $factor * ($totalizer_new - $totalizer_old);
    }

    public static function findFlowPercentSugarCane($flow, $sugar_cane)
    {
        return ($flow / $sugar_cane) * 1000;
    }
}
