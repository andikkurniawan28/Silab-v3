<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Analysis;
use App\Models\Material;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\CertificateContent;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $certificates = Certificate::all();
        $coas = Coa::all();
        return view('coa.index', compact('stations', 'certificates', 'coas'));
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
        Coa::create($request->all());
        return redirect()->back()->with('success', 'Cerficate berhasil digenerate');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coa = Coa::whereId($id)->get()->last();

        $datetime = date('Y-m-d 5:00', strtotime($coa->created_at));

        $material_id = CertificateContent::where('certificate_id', $coa->certificate_id)->get('material_id');

        foreach($material_id as $material_id){
            $data[$material_id->material_id] = Sample::where('material_id', $material_id->material_id)
                ->where('created_at', '>=', $datetime)
                ->where('created_at', '<', date('Y-m-d H:i', strtotime($datetime . "+24 hours")))
                ->get();
        }

        // return $data;
        return view('coa.show', compact('coa', 'data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function edit(Coa $coa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Cerficate berhasil digenerate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back()->with('success', 'Cerficate berhasil dihapus');
    }
}
