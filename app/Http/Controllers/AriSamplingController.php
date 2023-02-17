<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\AriSampling;
use Illuminate\Http\Request;

class AriSamplingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $ari_samplings = AriSampling::all();
        return view('ari_sampling.index', compact('stations', 'ari_samplings'));
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
        AriSampling::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AriSampling  $ariSampling
     * @return \Illuminate\Http\Response
     */
    public function show(AriSampling $ariSampling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AriSampling  $ariSampling
     * @return \Illuminate\Http\Response
     */
    public function edit(AriSampling $ariSampling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AriSampling  $ariSampling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rit_id' => 'required|unique:ari_samplings',
        ]);

        AriSampling::whereId($id)->update([
            'rit_id' => $request->rit_id,
            'rfid' => $request->rfid,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AriSampling  $ariSampling
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AriSampling::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
