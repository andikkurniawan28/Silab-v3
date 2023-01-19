<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kvalue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kactivity(){
        return $this->belongsTo(Kactivity::class);
    }

    public function kspot(){
        return $this->belongsTo(Kspot::class);
    }
}
