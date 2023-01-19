<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Indicator;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $indicators = Indicator::all();
        return view('indicator.index', compact('stations', 'indicators'));
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
        Indicator::create($request->all());
        Activity::insert([
            'subject' => 'Indicator',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Indikator berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $indicator
     * @return \Illuminate\Http\Response
     */
    public function show(Station $indicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $indicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $indicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Indicator::where('id', $id)->update([
            'name' => $request->name,
        ]);
        Activity::insert([
            'subject' => 'Indicator',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Indikator berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $indicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Indicator::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Indicator',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Indikator berhasil dihapus');
    }
}
