<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Material;
use Illuminate\Http\Request;

class CetakBarcodeController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $materials = Material::all();
        return view('cetak_barcode.index', compact('stations', 'materials'));
    }

    public function store(Request $request)
    {
        Sample::insert(['material_id' => $request->material_id, 'user_id' => Auth()->user()->id]);
        Activity::insert(['subject' => 'Cetak Barcode', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        $data = Sample::where('material_id', $request->material_id)->get()->last();
        return view('cetak_barcode.show', compact('data'));
    }
}
