<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Kvalue;
use Illuminate\Http\Request;

class KvalueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $kvalues = Kvalue::all();
        return view('kvalue.index', compact('stations', 'kvalues'));
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
        Kvalue::create($request->all());
        Activity::insert([
            'subject' => 'Kvalue',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Data Keliling berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $kvalue
     * @return \Illuminate\Http\Response
     */
    public function show(Station $kvalue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $kvalue
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $kvalue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $kvalue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Kvalue::where('id', $id)->update([
            'kactivity_id' => $request->kactivity_id,
            'kspot_id' => $request->kspot_id,
            'value' => $request->value,
        ]);
        Activity::insert([
            'subject' => 'Kvalue',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Data Keliling berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $kvalue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Kvalue::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Kvalue',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Data Keliling berhasil dihapus');
    }
}
