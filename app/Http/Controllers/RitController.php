<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Posbrix;
use App\Models\Station;
use Illuminate\Http\Request;

class RitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $rits = Rit::latest()->paginate(env('TABLE_LIMIT'));
        return view('rit.index', compact('rits', 'stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data_from_api = Rit::getInfoFromBarcodeAntrian($request->barcode_antrian);
        // $request->request->add([
        //     'register' => $data_from_api['register'],
        //     'nopol' => $data_from_api['nopol'],
        //     'petani' => $data_from_api['nama_petani'],
        // ]);
        // Rit::create($request->all());
        // $rit_id = Rit::where('register', $data_from_api['register'])->get()->last()->id;
        Rit::create($request->all());
        $rit_id = Rit::where('spta', $request->spta)->get()->last()->id;
        $spta = $request->spta;
        return view('aplikasi.posbrix', compact('rit_id', 'spta'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rit  $rit
     * @return \Illuminate\Http\Response
     */
    public function show(Rit $rit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rit  $rit
     * @return \Illuminate\Http\Response
     */
    public function edit(Rit $rit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rit  $rit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Rit::whereid($id)->update([
            'rfid' => $request->rfid,
            'barcode_antrian' => $request->barcode_antrian,
            'spta' => $request->spta,
            'register' => $request->register,
            'kud' => $request->kud,
            'pos' => $request->pos,
            'wilayah' => $request->wilayah,
            'petani' => $request->petani,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rit  $rit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rit::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
