<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function method()
    {
        return $this->hasMany(Method::class);
    }

    public function analysis()
    {
        return $this->hasMany(Analysis::class);
    }

    public function analysis_average(){
        return $this->hasMany(AnalysisAverage::class);
    }
}
