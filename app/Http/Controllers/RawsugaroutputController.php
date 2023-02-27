<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\Rawsugaroutput;

class RawsugaroutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $rawsugaroutputs = Rawsugaroutput::latest()->paginate(1000);
        return view('rawsugaroutput.index', compact('stations', 'rawsugaroutputs'));
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
        Rawsugaroutput::insert([
            'bruto' => $bruto,
            'tarra' => $request->tarra,
            'netto' => $request->netto,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rawsugaroutput  $rawsugaroutput
     * @return \Illuminate\Http\Response
     */
    public function show(Rawsugaroutput $rawsugaroutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rawsugaroutput  $rawsugaroutput
     * @return \Illuminate\Http\Response
     */
    public function edit(Rawsugaroutput $rawsugaroutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rawsugaroutput  $rawsugaroutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Rawsugaroutput::whereId($id)->update([
            'netto' => $request->netto,
            'tarra' => $request->tarra,
            'bruto' => $request->netto + $request->tarra,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rawsugaroutput  $rawsugaroutput
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rawsugaroutput::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
