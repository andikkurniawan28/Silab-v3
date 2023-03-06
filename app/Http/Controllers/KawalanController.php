<?php

namespace App\Http\Controllers;

use App\Models\Kawalan;
use App\Models\Station;
use Illuminate\Http\Request;

class KawalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $kawalans = Kawalan::all();
        return view('kawalan.index', compact('stations', 'kawalans'));
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
        $request->validate(['name' => 'required|unique:kawalans']);
        Kawalan::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kawalan  $kawalan
     * @return \Illuminate\Http\Response
     */
    public function show(Kawalan $kawalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kawalan  $kawalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kawalan $kawalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kawalan  $kawalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Kawalan::whereId($id)->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kawalan  $kawalan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kawalan::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
