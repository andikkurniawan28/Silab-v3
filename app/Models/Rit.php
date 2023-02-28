<?php

namespace App\Models;

use App\Models\Kud;
use App\Models\Wilayah;
use App\Models\Pospantau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posbrix(){
        return $this->hasMany(Posbrix::class);
    }

    public function ari(){
        return $this->hasMany(Ari::class);
    }

    // public function score(){
    //     return $this->hasMany(Score::class);
    // }

    public function kud(){
        return $this->belongsTo(Kud::class);
    }

    public function pospantau(){
        return $this->belongsTo(Pospantau::class);
    }

    public function wilayah(){
        return $this->belongsTo(Wilayah::class);
    }

    public static function generateDataFromPdeApi($rfid){

        $url = 'http://192.168.20.45:8111/rfid/info/';
        $request_url = $url.$rfid;
        $curl = curl_init($request_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [ 'authorization:PGKBA2023' ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        if($response != 'Internal Server Error')
        {
            $data = json_decode($response, true);
            $data['kud'] = self::findKud($data['register']);
            $data['pospantau'] = self::findPospantau($data['register']);
            $data['wilayah'] = self::findWilayah($data['register']);
        }
        else
        {
            $data['spta'] = NULL;
            $data['barcode_antrian'] = NULL;
            $data['register'] = NULL;
            $data['nopol'] = NULL;
            $data['nama_petani'] = NULL;
            $data['kud'] = NULL;
            $data['pospantau'] = NULL;
            $data['wilayah'] = NULL;
        }

        return $data;
    }

    public function findKud($register){

        $kud = substr($register, 0, 1);
        if(Kud::where('code', $kud)->count() > 0){
            return Kud::where('code', $kud)->get()->last()->id;
        } else {
            return NULL;
        }
    }

    public function findPospantau($register){
        $pospantau = substr($register, 1, 1);
        if(Pospantau::where('code', $pospantau)->count() > 0){
            return Pospantau::where('code', $pospantau)->get()->last()->id;
        } else {
            return NULL;
        }
    }

    public function findWilayah($register){
        $wilayah = substr($register, 2, 1);
        if(Wilayah::where('code', $wilayah)->count() > 0){
            return Wilayah::where('code', $wilayah)->get()->last()->id;
        } else {
            return NULL;
        }
    }
}
