<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Posbrix;
use Illuminate\Http\Request;

class PosbrixRfidController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Posbrix::where('spta', $request->spta)->update([
            'brix' => $request->brix,
            'variety_id' => $request->variety_id,
            'kawalan_id' => $request->kawalan_id,
            'is_accepted' => $request->is_accepted,
        ]);

        $posbrix_id = Posbrix::where('spta', $request->spta)->get()->last()->id;

        if($request->is_accepted == 1){
            Rit::insert([
                'posbrix_id' => $posbrix_id,
                'spta' => $request->spta,
                'category' => $request->category,
            ]);
        }

        if($request->category == 'EK'){
            return redirect()->route('scan_rfid')->with('success', 'Data berhasil disimpan');
        }
        else{
            return redirect()->route('scan_rfid_eb')->with('success', 'Data berhasil disimpan');
        }

    }
}
