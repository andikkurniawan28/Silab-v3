<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Analysis;
use App\Models\Material;
use App\Models\Indicator;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $analyses = Analysis::latest()->paginate(env('TABLE_LIMIT'));
        $indicators = Indicator::all();
        return view('analysis.index', compact('stations', 'analyses', 'indicators'));
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
        Analysis::create($request->all());
        Activity::insert([
            'subject' => 'Analysis',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Analisa berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function show(Analysis $analysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stations = Station::all();
        $samples = Sample::all();
        $analysis = Analysis::whereId($id)->get()->last();
        $indicators = Indicator::all();
        return view('analysis.edit', compact('stations', 'analysis', 'indicators', 'samples'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Analysis::where('id', $id)->update([
            'sample_id' => $request->sample_id,
            'indicator_id' => $request->indicator_id,
            'value' => $request->value,
        ]);
        Activity::insert([
            'subject' => 'Analysis',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->route('analyses.index')
            ->with('success', 'Analisa berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Analysis::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Analysis',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Analisa berhasil dihapus');
    }
}
