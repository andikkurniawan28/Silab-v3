<?php

namespace App\Http\Controllers;

use App\Models\mollase;
use App\Models\Station;
use Illuminate\Http\Request;

class MollaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $mollases = Mollase::latest()->paginate(1000);
        return view('mollase.index', compact('stations', 'mollases'));
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
        $bruto = $request->netto + $request->tarra;
        Mollase::insert([
            'bruto' => $bruto,
            'tarra' => $request->tarra,
            'netto' => $request->netto,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mollase  $mollase
     * @return \Illuminate\Http\Response
     */
    public function show(mollase $mollase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mollase  $mollase
     * @return \Illuminate\Http\Response
     */
    public function edit(mollase $mollase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mollase  $mollase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Mollase::whereId($id)->update([
            'netto' => $request->netto,
            'tarra' => $request->tarra,
            'bruto' => $request->netto + $request->tarra,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mollase  $mollase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mollase::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
