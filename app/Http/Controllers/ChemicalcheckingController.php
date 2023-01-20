<?php

namespace App\Http\Controllers;

use App\Models\Chemical;
use App\Models\Chemicalvalue;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Chemicalchecking;
use Illuminate\Http\Request;

class ChemicalcheckingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $chemicalcheckings = Chemicalchecking::all();
        $chemicals = Chemical::all();
        return view('chemicalchecking.index', compact('stations', 'chemicalcheckings', 'chemicals'));
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
        Chemicalchecking::insert(['user_id' => Auth()->user()->id]);
        $chemicalchecking_id = Chemicalchecking::where('user_id', Auth()->user()->id)->orderBy('id', 'desc')->limit(1)->get()->last()->id;

        $chemicals = Chemical::all();

        foreach($chemicals as $chemical)
        {
            $input = 'chemical'.$chemical->id;
            if($request->$input != NULL){
                Chemicalvalue::insert([
                    'chemicalchecking_id' => $chemicalchecking_id,
                    'chemical_id' => $chemical->id,
                    'value' => $request->$input
                ]);
            }
        }

        Activity::insert([
            'subject' => 'Chemicalchecking',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Penggunaan BPP berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chemicalchecking  $chemicalchecking
     * @return \Illuminate\Http\Response
     */
    public function show(Chemicalchecking $chemicalchecking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chemicalchecking  $chemicalchecking
     * @return \Illuminate\Http\Response
     */
    public function edit(Chemicalchecking $chemicalchecking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chemicalchecking  $chemicalchecking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Chemicalchecking::where('id', $id)->update([
        //     'user_id' => $request->user_id,
        // ]);
        // Activity::insert([
        //     'subject' => 'Chemicalchecking',
        //     'subject_id' => $id,
        //     'action' => 'Edit',
        //     'user_id' => Auth()->user()->id,
        // ]);
        // return redirect()->back()->with('success', 'Penggunaan BPP berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chemicalchecking  $chemicalchecking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chemicalchecking::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Chemicalchecking',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Penggunaan BPP berhasil dihapus');
    }
}
