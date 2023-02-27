<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Material;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\CertificateContent;

class CertificateContentController extends Controller
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
        $materials = Material::all();
        $certificate_contents = CertificateContent::all();
        return view('certificate_content.index', compact('stations', 'certificate_contents', 'certificates', 'materials'));
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
        CertificateContent::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CertificateContent  $certificateContent
     * @return \Illuminate\Http\Response
     */
    public function show(CertificateContent $certificateContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CertificateContent  $certificateContent
     * @return \Illuminate\Http\Response
     */
    public function edit(CertificateContent $certificateContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CertificateContent  $certificateContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CertificateContent::whereId($id)->update([
            'certificate_id' => $request->certificate_id,
            'material_id' => $request->material_id,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CertificateContent  $certificateContent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CertificateContent::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
