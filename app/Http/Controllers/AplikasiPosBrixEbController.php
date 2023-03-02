<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Posbrix;
use Illuminate\Http\Request;

class AplikasiPosBrixEbController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'spta' => 'required|unique:posbrixes|unique:rits'
        ]);

        Posbrix::create($request->all());

        return redirect()->route('posbrix', array('spta' => $request->spta, 'category' => $request->category));
    }
}
