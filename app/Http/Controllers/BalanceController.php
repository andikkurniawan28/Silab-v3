<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Station;
use App\Models\Activity;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $balances = Balance::all();
        return view('balance.index', compact('stations', 'balances'));
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
        $data = Balance::countRawJuice($request);
        $request->request->add([
            'flow_nm' => $data['flow_nm'],
            'nm_persen_tebu' => $data['nm_persen_tebu'],
        ]);
        Balance::create($request->all());
        Activity::insert(['subject' => 'Balance', 'action' => 'Create', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Balance::whereId($id)->update([
            'tebu' => $request->tebu,
            'totalizer' => $request->totalizer,
            'flow_nm' => $request->flow_nm,
            'nm_persen_tebu' => $request->nm_persen_tebu,
        ]);
        Activity::insert(['subject' => 'Balance', 'subject_id' => $id, 'action' => 'Edit', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Balance::whereId($id)->delete();
        Activity::insert(['subject' => 'Balance', 'subject_id' => $id, 'action' => 'Delete', 'user_id' => Auth()->user()->id]);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
