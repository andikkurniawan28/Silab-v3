<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\AriSampling;
use Illuminate\Http\Request;

class AplikasiTapTimbanganController extends Controller
{
    public function index(){
        return view('aplikasi.tap_timbangan');
    }

    public function process(Request $request){
        Rit::insert(['rfid' => $request->rfid]);

        $rit_id = Rit::where('rfid', $request->rfid)->get()->last()->id;

        AriSampling::insert([
            'rit_id' => $rit_id,
            'user_id' => Auth()->user()->id,
        ]);

        return view('aplikasi.tap_sukses');
    }
}
