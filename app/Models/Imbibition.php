<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imbibition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function countFlow($request)
    {
        $count = self::count();
        if($count != 0)
        {
            $totalizer_latest = self::get()->last()->totalizer;
            $flow_imb = self::findFlow($totalizer_latest, $request->totalizer);
            // $imb_persen_tebu = self::findFlowPercentSugarCane($flow_imb, $request->tebu);
        }
        else
        {
            $flow_imb = 0;
            // $imb_persen_tebu = 0;
        }
        return $data = [
            'flow_imb' => $flow_imb,
            // 'imb_persen_tebu' => $imb_persen_tebu,
        ];
    }

    public static function findFlow($totalizer_old, $totalizer_new)
    {
        $factor = Factor::where('name', 'Raw Juice')->get()->last()->value;
        return $factor * ($totalizer_new - $totalizer_old);
    }

    // public static function findFlowPercentSugarCane($flow, $sugar_cane)
    // {
    //     return ($flow / $sugar_cane) * 1000;
    // }
}
