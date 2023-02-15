<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Posbrix;
use App\Models\Station;
use Illuminate\Http\Request;

class PosbrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $posbrixes = Posbrix::all();
        return view('posbrix.index', compact('posbrixes', 'stations'));
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
        Posbrix::create($request->all());
        $spta = $request->spta;
        return redirect()->route('posbrix', $spta);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posbrix  $posbrix
     * @return \Illuminate\Http\Response
     */
    public function show(Posbrix $posbrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posbrix  $posbrix
     * @return \Illuminate\Http\Response
     */
    public function edit(Posbrix $posbrix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posbrix  $posbrix
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Posbrix::whereId($id)->update([
            'brix' => $request->brix,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posbrix  $posbrix
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posbrix::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
