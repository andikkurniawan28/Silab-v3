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
            'is_accepted' => $request->is_accepted,
        ]);

        return redirect()->route('scan_rfid')->with('success', 'Data berhasil disimpan');
    }
}
