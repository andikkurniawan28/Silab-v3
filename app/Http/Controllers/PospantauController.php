<?php

namespace App\Http\Controllers;

use App\Models\Pospantau;
use App\Models\Station;
use Illuminate\Http\Request;

class PospantauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $pospantaus = Pospantau::all();
        return view('pospantau.index', compact('stations', 'pospantaus'));
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
        Pospantau::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pospantau  $pospantau
     * @return \Illuminate\Http\Response
     */
    public function show(Pospantau $pospantau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pospantau  $pospantau
     * @return \Illuminate\Http\Response
     */
    public function edit(Pospantau $pospantau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pospantau  $pospantau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Pospantau::whereId($id)->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pospantau  $pospantau
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pospantau::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
