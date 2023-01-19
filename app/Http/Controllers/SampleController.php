<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Material;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $samples = Sample::latest()->paginate(10000);
        $materials = Material::all();
        return view('sample.index', compact('stations', 'samples', 'materials'));
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
        Sample::create($request->all());
        Activity::insert([
            'subject' => 'Sample',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Sampel '.Material::whereId($request->material_id)->get()->last()->name.' berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stations = Station::all();
        $sample = Sample::whereId($id)->get()->last();
        $materials = Material::all();
        return view('sample.edit', compact('stations', 'sample', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Sample::where('id', $id)->update(['material_id' => $request->material_id]);
        Activity::insert([
            'subject' => 'Sample',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->route('samples.index')
            ->with('success', 'Sampel berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Sample::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Sample',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Sampel '.Material::whereId($request->material_id)->get()->last()->name.' berhasil dihapus');
    }
}
