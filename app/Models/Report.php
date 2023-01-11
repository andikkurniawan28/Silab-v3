<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Station;
use App\Models\Indicator;
use App\Models\Material;
use App\Models\Method;
use App\Models\Sample;
use App\Models\Analysis;

class Report extends Model
{
    use HasFactory;

    public function serve()
    {
        $data = [];
        $stations = Station::all();
        for($i=0; $i < count($stations); $i++)
        {
            $data[$i]['station'] = $stations[$i]->name;
            for($j=0; $j<count($stations[$i]->material); $j++)
            {
                $data[$i]['material'][$j] = $stations[$i]->material[$j]->name;

            }
        }
        return $data;
    }
}
