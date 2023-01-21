<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Material;
use Illuminate\Http\Request;

class CetakRonselController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Material::where('station_id', 6)->where('name', 'like', 'Masakan %')->get();
        return view('cetak_ronsel.index', compact('stations', 'materials'));
    }

    public function store(Request $request)
    {
        Sample::create($request->all());
        Activity::insert(['subject' => 'Cetak Ronsel', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        $data = Sample::where('material_id', $request->material_id)->get()->last();
        return view('cetak_ronsel.show', compact('data'));
    }

}
