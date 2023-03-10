<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Kawalan;
use App\Models\Posbrix;
use App\Models\Station;
use App\Models\Variety;
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
        $posbrixes = Posbrix::latest()->paginate(env('TABLE_LIMIT'));
        $varieties = Variety::all();
        $kawalans = Kawalan::all();
        return view('posbrix.index', compact('posbrixes', 'stations', 'varieties', 'kawalans'));
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
        $request->validate([
            'spta' => 'required|unique:posbrixes',
            'category' => 'required',
            'brix' => 'required',
            'is_accepted' => 'required',
        ]);
        Posbrix::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
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
        $request->validate([
            'category' => 'required',
            'brix' => 'required',
            'is_accepted' => 'required',
        ]);

        Posbrix::whereId($id)->update([
            'category' => $request->category,
            'brix' => $request->brix,
            'variety_id' => $request->variety_id,
            'kawalan_id' => $request->kawalan_id,
            'is_accepted' => $request->is_accepted,
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
