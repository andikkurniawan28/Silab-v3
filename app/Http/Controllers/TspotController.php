<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Tspot;
use Illuminate\Http\Request;

class TspotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $tspots = Tspot::all();
        return view('tspot.index', compact('stations', 'tspots'));
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
        Tspot::create($request->all());
        Activity::insert([
            'subject' => 'Tspot',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Titik Taksasi berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $tspot
     * @return \Illuminate\Http\Response
     */
    public function show(Station $tspot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $tspot
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $tspot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $tspot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tspot::where('id', $id)->update([
            'name' => $request->name,
        ]);
        Activity::insert([
            'subject' => 'Tspot',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Titik Taksasi berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $tspot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Tspot::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Tspot',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Titik Taksasi berhasil dihapus');
    }
}
