<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chemical extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chemicalvalue(){
        return $this->hasMany(Chemicalvalue::class);
    }
}
