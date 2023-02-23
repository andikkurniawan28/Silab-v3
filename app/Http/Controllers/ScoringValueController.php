<?php

namespace App\Http\Controllers;

use App\Models\Dirt;
use App\Models\Score;
use App\Models\Station;
use App\Models\ScoringValue;
use Illuminate\Http\Request;

class ScoringValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scoring_values = ScoringValue::latest()->paginate(env('TABLE_LIMIT'));
        $stations = Station::all();
        $dirts = Dirt::all();
        $scores = Score::all();
        return view('scoring_value.index', compact('scoring_values', 'stations', 'dirts', 'scores'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScoringValue  $scoringValue
     * @return \Illuminate\Http\Response
     */
    public function show(ScoringValue $scoringValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScoringValue  $scoringValue
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoringValue $scoringValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoringValue  $scoringValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoringValue $scoringValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoringValue  $scoringValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoringValue $scoringValue)
    {
        ScoringValue::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
