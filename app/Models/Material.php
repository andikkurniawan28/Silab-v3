<?php

namespace App\Models;

use App\Models\Sample;
use App\Models\Analysis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function method()
    {
        return $this->hasMany(Method::class);
    }

    public function sample()
    {
        return $this->hasMany(Sample::class);
    }

    public function certificate_content(){
        return $this->hasMany(CertificateContent::class);
    }

    public function analysis_average(){
        return $this->hasMany(AnalysisAverage::class);
    }
}
