<?php

namespace App\Http\Controllers;

use App\Models\Station;
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
        $certificate_contents = CertificateContent::all();
        return view('certificate_content.index', compact('stations', 'certificate_contents'));
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
    public function update(Request $request, CertificateContent $certificateContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CertificateContent  $certificateContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CertificateContent $certificateContent)
    {
        //
    }
}
