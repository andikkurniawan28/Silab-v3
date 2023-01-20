<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chemicalvalue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chemicalchecking(){
        return $this->belongsTo(Chemicalchecking::class);
    }

    public function chemical(){
        return $this->belongsTo(Chemical::class);
    }
}
