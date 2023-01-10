<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
