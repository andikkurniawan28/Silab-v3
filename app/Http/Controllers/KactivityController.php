<?php

namespace App\Http\Controllers;

use App\Models\Kspot;
use App\Models\Kvalue;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Kactivity;
use Illuminate\Http\Request;

class KactivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $kactivities = Kactivity::latest()->paginate(env('TABLE_LIMIT'));
        $kspots = Kspot::all();
        return view('kactivity.index', compact('stations', 'kactivities', 'kspots'));
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
        Kactivity::insert(['user_id' => Auth()->user()->id]);
        $kactivity_id = Kactivity::orderBy('id', 'desc')->limit(1)->get()->last()->id;

        $kspots = Kspot::all();

        foreach($kspots as $kspot)
        {
            $input = 'kspot'.$kspot->id;
            if($request->$input != NULL){
                Kvalue::insert([
                    'kactivity_id' => $kactivity_id,
                    'kspot_id' => $kspot->id,
                    'value' => $request->$input
                ]);
            }
        }

        Activity::insert([
            'subject' => 'Kactivity',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Keliling Proses berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kactivity  $kactivity
     * @return \Illuminate\Http\Response
     */
    public function show(Kactivity $kactivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kactivity  $kactivity
     * @return \Illuminate\Http\Response
     */
    public function edit(Kactivity $kactivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kactivity  $kactivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Kactivity::where('id', $id)->update([
        //     'user_id' => $request->user_id,
        // ]);
        // Activity::insert([
        //     'subject' => 'Kactivity',
        //     'subject_id' => $id,
        //     'action' => 'Edit',
        //     'user_id' => Auth()->user()->id,
        // ]);
        // return redirect()->back()->with('success', 'Keliling Proses berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kactivity  $kactivity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kactivity::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Kactivity',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Keliling Proses berhasil dihapus');
    }
}
