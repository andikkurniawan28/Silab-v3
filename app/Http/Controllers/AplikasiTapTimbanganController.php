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

        $data = Rit::generateDataFromPdeApi($request->rfid);

        if(Rit::where('spta', $data['spta'])->count() == 1){

            Rit::where('spta', $data['spta'])->update([
                'rfid' => $request->rfid,
                'barcode_antrian' => $data['barcode_antrian'],
                'register' => $data['register'],
                'nopol' => $data['nopol'],
                'petani' => $data['nama_petani'],
                'kud_id' => $data['kud'],
                'pospantau_id' => $data['pospantau'],
                'wilayah_id' => $data['wilayah'],
            ]);

            $rit_id = Rit::where('rfid', $request->rfid)->get()->last()->id;

            if(AriSampling::where('rit_id', $rit_id)->count() == 0){
                AriSampling::insert([
                    'rit_id' => $rit_id,
                    'user_id' => Auth()->user()->id,
                    'category' => 'EK',
                ]);
            }
            else {
                return redirect()->back()->with('error', 'Gagal simpan');
            }

            return view('aplikasi.tap_sukses');
        }
        else
        {
            return redirect()->back()->with('error', 'Gagal simpan');
        }
    }
}
