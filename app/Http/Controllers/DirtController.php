<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Dirt;
use Illuminate\Http\Request;

class DirtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $dirts = Dirt::all();
        return view('dirt.index', compact('stations', 'dirts'));
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
        Dirt::create($request->all());
        Activity::insert([
            'subject' => 'Dirt',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Kotoran berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $dirt
     * @return \Illuminate\Http\Response
     */
    public function show(Station $dirt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $dirt
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $dirt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $dirt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Dirt::where('id', $id)->update([
            'name' => $request->name,
        ]);
        Activity::insert([
            'subject' => 'Dirt',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Kotoran berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $dirt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Dirt::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Dirt',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Kotoran berhasil dihapus');
    }
}
