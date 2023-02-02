<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Activity;
use App\Models\Factor;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $factors = Factor::all();
        return view('factor.index', compact('stations', 'factors'));
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
        Factor::create($request->all());
        Activity::insert([
            'subject' => 'Factor',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Faktor berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $factor
     * @return \Illuminate\Http\Response
     */
    public function show(Station $factor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $factor
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $factor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $factor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Factor::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'value' => $request->value,
        ]);
        Activity::insert([
            'subject' => 'Factor',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Faktor berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $factor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Factor::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Factor',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Faktor berhasil dihapus');
    }
}
