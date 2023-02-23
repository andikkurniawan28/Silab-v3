<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function certificate(){
        return $this->belongsTo(Certificate::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
