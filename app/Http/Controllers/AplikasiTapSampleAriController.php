<?php

namespace App\Http\Controllers;

use App\Models\AriSampling;
use Illuminate\Http\Request;

class AplikasiTapSampleAriController extends Controller
{
    public function index(){
        return view('aplikasi.tap_sampling_ari');
    }

    public function process(Request $request){

        $ari_sampling_id = AriSampling::where('category', 'EK')->whereNull('rfid');

        if($ari_sampling_id->count() == 0){
            return redirect()->route('tap_sample_ari')->with('success', 'Data gagal simpan');
        }
        else {
            AriSampling::whereId($ari_sampling_id->get()->first()->id)->update([
                'rfid' => $request->rfid,
            ]);
            return redirect()->route('tap_sample_ari')->with('success', 'Data berhasil disimpan');
        }
    }
}
