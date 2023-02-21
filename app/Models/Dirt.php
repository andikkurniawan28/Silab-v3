<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dirt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scoring_value(){
        return $this->hasMany(ScoringValue::class);
    }
}
