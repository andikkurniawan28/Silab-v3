<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $stations = Station::all();
        return view('home.index', compact('stations'));
    }
}
