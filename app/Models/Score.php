<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rit(){
        return $this->belongsTo(Rit::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scoring_value(){
        return $this->hasMany(ScoringValue::class);
    }

}
