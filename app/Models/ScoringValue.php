<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoringValue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function score(){
        return $this->belongsTo(Score::class);
    }

    public function dirt(){
        return $this->belongsTo(Dirt::class);
    }
}
