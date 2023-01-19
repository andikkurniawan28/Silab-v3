<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Station;
use App\Models\Activity;
use App\Models\Material;
use App\Models\Indicator;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $methods = Method::all();
        $materials = Material::all();
        $indicators = Indicator::all();
        return view('method.index', compact('stations', 'methods', 'materials', 'indicators'));
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
        Method::create($request->all());
        Activity::insert([
            'subject' => 'Method',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Metode berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $method
     * @return \Illuminate\Http\Response
     */
    public function show(Station $method)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $method
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stations = Station::all();
        $method = Method::whereId($id)->get()->last();
        $materials = Material::all();
        $indicators = Indicator::all();
        return view('method.edit', compact('stations', 'method', 'materials', 'indicators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $method
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Method::where('id', $id)->update([
            'material_id' => $request->material_id,
            'indicator_id' => $request->indicator_id,
        ]);
        Activity::insert([
            'subject' => 'Method',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->route('methods.index')
            ->with('success', 'Metode berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $method
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Method::whereId($id)->delete();
        Activity::insert([
            'subject' => 'Method',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Metode berhasil dihapus');
    }
}
