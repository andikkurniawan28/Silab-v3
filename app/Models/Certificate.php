<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function certificate_content(){
        return $this->hasMany(CertificateContent::class);
    }

    public function coa(){
        return $this->hasMany(Coa::class);
    }
}
