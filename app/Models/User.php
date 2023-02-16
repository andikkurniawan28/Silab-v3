<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'role_id',
        'username',
        'password',
        'name',
        'is_active',
        'hmi_access',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sample()
    {
        return $this->hasMany(Sample::class);
    }

    public function analysis()
    {
        return $this->hasMany(Analysis::class);
    }

    public function balance()
    {
        return $this->hasMany(Balance::class);
    }

    public function ari_sampling()
    {
        return $this->hasMany(AriSampling::class);
    }
}
