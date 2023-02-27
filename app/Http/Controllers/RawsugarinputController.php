<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\Rawsugarinput;

class RawsugarinputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $rawsugarinputs = Rawsugarinput::latest()->paginate(1000);
        return view('rawsugarinput.index', compact('stations', 'rawsugarinputs'));
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
        Rawsugarinput::insert([
            'bruto' => $bruto,
            'tarra' => $request->tarra,
            'netto' => $request->netto,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rawsugarinput  $rawsugarinput
     * @return \Illuminate\Http\Response
     */
    public function show(Rawsugarinput $rawsugarinput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rawsugarinput  $rawsugarinput
     * @return \Illuminate\Http\Response
     */
    public function edit(Rawsugarinput $rawsugarinput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rawsugarinput  $rawsugarinput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Rawsugarinput::whereId($id)->update([
            'netto' => $request->netto,
            'tarra' => $request->tarra,
            'bruto' => $request->netto + $request->tarra,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rawsugarinput  $rawsugarinput
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rawsugarinput::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
