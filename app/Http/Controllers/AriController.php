<?php

namespace App\Http\Controllers;

use App\Models\Ari;
use App\Models\Rit;
use App\Models\Factor;
use App\Models\Station;
use App\Models\AriSampling;
use Illuminate\Http\Request;

class AriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $aris = Ari::latest()->paginate(env('TABLE_LIMIT'));
        return view('ari.index', compact('aris', 'stations'));
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
        $request->validate([
            'pbrix' => 'required',
            'ppol' => 'required',
            'pol' => 'required',
            'user_id' => 'required',
        ]);
        if(AriSampling::where('rfid', $request->rfid)->count() > 0){

            $ari_sampling_id = AriSampling::where('rfid', $request->rfid)->get()->last()->id;
            $category = AriSampling::whereId($ari_sampling_id)->get()->last()->category;
            $ppol = self::correctPol($request);
            $request->request->add(['ppol' => $ppol]);
            $yield = self::findYield($request);
            $request->request->add([
                'category' => $category,
                'yield' => $yield,
            ]);

            if(Ari::where('ari_sampling_id', $ari_sampling_id)->count() == 0){
                Ari::insert([
                    'ari_sampling_id' => $ari_sampling_id,
                    'pbrix' => $request->pbrix,
                    'ppol' => $ppol,
                    'pol' => $request->pol,
                    'yield' => $request->yield,
                    'category' => $request->category,
                    'user_id' => $request->user_id,
                ]);
                return redirect()->back()->with('success', 'Data berhasil disimpan');
            }
            else {
                return redirect()->back()->with('error', 'Data gagal simpan');
            }
        }
        else {
            return redirect()->back()->with('error', 'Sampel tidak terdaftar');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function show(Ari $ari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function edit(Ari $ari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pbrix' => 'required',
            'ppol' => 'required',
            'pol' => 'required',
        ]);
        $category = AriSampling::whereId($request->ari_sampling_id)->get()->last()->category;
        $ppol = self::correctPol($request);
        $request->request->add(['ppol' => $ppol]);
        $yield = self::findYield($request);
        $request->request->add([
            'category' => $category,
            'yield' => $yield,
        ]);
        Ari::whereId($id)->update([
            'ari_sampling_id' => $request->ari_sampling_id,
            'category' => $request->category,
            'pbrix' => $request->pbrix,
            'ppol' => $request->ppol,
            'pol' => $request->pol,
            'yield' => $request->yield,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ari  $ari
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ari::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function correctPol($request){
        $faktor = Factor::where('name', 'Saccharomat')->get()->last()->value;
        return $request->ppol + ($faktor * $request->pbrix);
    }

    public function findYield($request){
        $faktor_rendemen = Factor::where('name', 'Rendemen')->get()->last()->value;
        $faktor_mellase = Factor::where('name', 'Mollases')->get()->last()->value;
        return $faktor_rendemen * ($request->ppol - $faktor_mellase * ($request->pbrix - $request->ppol));
    }
}
