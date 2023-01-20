<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tvalue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tactivity(){
        return $this->belongsTo(Tactivity::class);
    }

    public function tspot(){
        return $this->belongsTo(Tspot::class);
    }
}
