<?php

namespace App\Http\Controllers;

use App\Models\Imbibition;
use App\Models\Station;
use App\Models\Activity;
use Illuminate\Http\Request;

class ImbibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $imbibitions = Imbibition::all();
        return view('imbibition.index', compact('stations', 'imbibitions'));
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
        $data = Imbibition::countFlow($request);
        $request->request->add([
            'flow_imb' => $data['flow_imb'],
        ]);
        Imbibition::create($request->all());
        Activity::insert(['subject' => 'Imbibition', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imbibition  $imbibition
     * @return \Illuminate\Http\Response
     */
    public function show(Imbibition $imbibition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imbibition  $imbibition
     * @return \Illuminate\Http\Response
     */
    public function edit(Imbibition $imbibition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imbibition  $imbibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Imbibition::whereId($id)->update([
            'tebu' => $request->tebu,
            'totalizer' => $request->totalizer,
            'flow_nm' => $request->flow_nm,
            'nm_persen_tebu' => $request->nm_persen_tebu,
        ]);
        Activity::insert(['subject' => 'Imbibition', 'subject_id' => $id, 'action' => 'Edit', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imbibition  $imbibition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Imbibition::whereId($id)->delete();
        Activity::insert(['subject' => 'Imbibition', 'subject_id' => $id, 'action' => 'Delete', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
