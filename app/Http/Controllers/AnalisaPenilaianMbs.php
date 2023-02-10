<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Score;
use Illuminate\Http\Request;

class AnalisaPenilaianMbs extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $score_rit_id = Score::select('rit_id')->get();
        $rits = Rit::whereNotIn('id', $score_rit_id)->get();
        return view('aplikasi.score', compact('rits'));
    }
}
