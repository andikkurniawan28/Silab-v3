<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringSaveDateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->session()->regenerate();
        $request->session()->put('date', $request->date);
        return redirect()->route('monitoring');
    }
}
