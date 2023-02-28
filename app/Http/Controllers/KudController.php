<?php

namespace App\Http\Controllers;

use App\Models\Kud;
use App\Models\Station;
use Illuminate\Http\Request;

class KudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $kuds = Kud::all();
        return view('kud.index', compact('stations', 'kuds'));
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
        Kud::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kud  $kud
     * @return \Illuminate\Http\Response
     */
    public function show(Kud $kud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kud  $kud
     * @return \Illuminate\Http\Response
     */
    public function edit(Kud $kud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kud  $kud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Kud::whereId($id)->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kud  $kud
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kud::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
