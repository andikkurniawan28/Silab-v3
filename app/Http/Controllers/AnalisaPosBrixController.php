<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Posbrix;
use Illuminate\Http\Request;

class AnalisaPosBrixController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posbrix_rit_id = Posbrix::select('rit_id')->get();
        $rits = Rit::whereNotIn('id', $posbrix_rit_id)->get();
        return view('analisa.posbrix', compact('rits'));
    }
}
