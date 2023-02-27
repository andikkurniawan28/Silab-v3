<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\AriSampling;
use Illuminate\Http\Request;

class AplikasiTapTimbanganEbController extends Controller
{
    public function index(){
        return view('aplikasi.tap_timbangan2');
    }

    public function process(Request $request){
        Rit::insert(['rfid' => $request->rfid]);

        // Rit::where('spta', $data['spta'])->update([
        //     'rfid' => $request->rfid,
        //     'barcode_antrian' => $data['barcode_antrian'],
        //     'register' => $data['register'],
        //     'nopol' => $data['nopol'],
        //     'petani' => $data['nama_petani'],
        // ]);

        // $rit_id = Rit::where('rfid', $request->rfid)->get()->last()->id;

        // AriSampling::insert([
        //     'rit_id' => $rit_id,
        //     'user_id' => Auth()->user()->id,
        //     'category' => 'EB|GD',
        // ]);

        // return view('aplikasi.tap_sukses2');

        return $data;
    }
}
