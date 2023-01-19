<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Kspot;
use Illuminate\Http\Request;

class KspotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $kspots = Kspot::all();
        return view('kspot.index', compact('stations', 'kspots'));
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
        Kspot::create($request->all());
        Activity::insert([
            'subject' => 'Kspot',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Titik Keliling berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $kspot
     * @return \Illuminate\Http\Response
     */
    public function show(Station $kspot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $kspot
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $kspot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $kspot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Kspot::where('id', $id)->update([
            'name' => $request->name,
        ]);
        Activity::insert([
            'subject' => 'Kspot',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Titik Keliling berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $kspot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Kspot::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Kspot',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Titik Keliling berhasil dihapus');
    }
}
