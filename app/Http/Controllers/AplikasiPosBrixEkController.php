<?php

namespace App\Http\Controllers;

use App\Models\Posbrix;
use Illuminate\Http\Request;

class AplikasiPosBrixEkController extends Controller
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
            'spta' => 'required|unique:posbrixes'
        ]);
        Posbrix::create($request->all());
        $spta = $request->spta;
        $category = $request->category;
        return redirect()->route('posbrix', array('spta' => $spta, 'category' => $category));
    }
}
