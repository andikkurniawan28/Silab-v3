<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Analysis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
