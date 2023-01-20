<?php

namespace App\Http\Controllers;

use App\Models\Tspot;
use App\Models\Tvalue;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Tactivity;
use Illuminate\Http\Request;

class TactivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $tactivities = Tactivity::all();
        $tspots = Tspot::all();
        return view('tactivity.index', compact('stations', 'tactivities', 'tspots'));
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
        Tactivity::insert(['user_id' => Auth()->user()->id]);
        $tactivity_id = Tactivity::where('user_id', Auth()->user()->id)->orderBy('id', 'desc')->limit(1)->get()->last()->id;

        $tspots = Tspot::all();

        foreach($tspots as $tspot)
        {
            $input = 'tspot'.$tspot->id;
            if($request->$input != NULL){
                Tvalue::insert([
                    'tactivity_id' => $tactivity_id,
                    'tspot_id' => $tspot->id,
                    'value' => $request->$input
                ]);
            }
        }

        Activity::insert([
            'subject' => 'Tactivity',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Taksasi berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tactivity  $tactivity
     * @return \Illuminate\Http\Response
     */
    public function show(Tactivity $tactivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tactivity  $tactivity
     * @return \Illuminate\Http\Response
     */
    public function edit(Tactivity $tactivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tactivity  $tactivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Tactivity::where('id', $id)->update([
        //     'user_id' => $request->user_id,
        // ]);
        // Activity::insert([
        //     'subject' => 'Tactivity',
        //     'subject_id' => $id,
        //     'action' => 'Edit',
        //     'user_id' => Auth()->user()->id,
        // ]);
        // return redirect()->back()->with('success', 'Taksasi berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tactivity  $tactivity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tactivity::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Tactivity',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Taksasi berhasil dihapus');
    }
}
