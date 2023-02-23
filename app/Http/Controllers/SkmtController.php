<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class SkmtController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $score = Score::whereId($id)->get()->last();
        return view('score.skmt', compact('score'));
    }
}
