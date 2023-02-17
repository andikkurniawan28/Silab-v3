<?php

namespace App\Http\Controllers;

use App\Models\AriSampling;
use Illuminate\Http\Request;

class AplikasiTapSampleAriEbController extends Controller
{
    public function index(){
        return view('aplikasi.tap_sampling_ari2');
    }

    public function process(Request $request){

        $ari_sampling_id = AriSampling::where('category', 'EB|GD')->whereNull('rfid');

        if($ari_sampling_id->count() == 0){
            return redirect()->route('tap_sample_ari_eb')->with('success', 'Data gagal simpan');
        }
        else {
            AriSampling::whereId($ari_sampling_id->get()->first()->id)->update([
                'rfid' => $request->rfid,
            ]);
            return redirect()->route('tap_sample_ari_eb')->with('success', 'Data berhasil disimpan');
        }
    }
}
