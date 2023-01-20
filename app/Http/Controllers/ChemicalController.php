<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Chemical;
use Illuminate\Http\Request;

class ChemicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $chemicals = Chemical::all();
        return view('chemical.index', compact('stations', 'chemicals'));
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
        Chemical::create($request->all());
        Activity::insert([
            'subject' => 'Chemical',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Bahan Pembantu Proses berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $chemical
     * @return \Illuminate\Http\Response
     */
    public function show(Chemical $chemical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $chemical
     * @return \Illuminate\Http\Response
     */
    public function edit(Chemical $chemical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $chemical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Chemical::where('id', $id)->update([
            'name' => $request->name,
        ]);
        Activity::insert([
            'subject' => 'Chemical',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Bahan Pembantu Proses berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $chemical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Chemical::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Chemical',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Bahan Pembantu Proses berhasil dihapus');
    }
}
