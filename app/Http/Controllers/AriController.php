<?php

namespace App\Http\Controllers;

use App\Models\Ari;
use App\Models\Rit;
use App\Models\Station;
use App\Models\AriSampling;
use Illuminate\Http\Request;

class AriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $aris = Ari::all();
        return view('ari.index', compact('aris', 'stations'));
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
        $category = AriSampling::whereId($request->ari_sampling_id)->get()->last()->category;
        $request->request->add([
            'category' => $category,
        ]);
        Ari::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function show(Ari $ari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function edit(Ari $ari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = AriSampling::whereId($request->ari_sampling_id)->get()->last()->category;
        $request->request->add([
            'category' => $category,
        ]);
        Ari::whereId($id)->update([
            'ari_sampling_id' => $request->ari_sampling_id,
            'category' => $category,
            'pbrix' => $request->pbrix,
            'ppol' => $request->ppol,
            'pol' => $request->pol,
            'yield' => $request->yield,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ari::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
