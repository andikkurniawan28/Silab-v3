<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Dirt;
use App\Models\Score;
use App\Models\Station;
use App\Models\ScoringValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $scores = Score::latest()->paginate(env('TABLE_LIMIT'));
        $dirts = Dirt::all();
        $score_rit_id = Score::select('rit_id')->get();
        $rits = Rit::whereNotIn('id', $score_rit_id)->get();
        return view('score.index', compact('scores', 'rits', 'stations', 'dirts'));
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
            'rit_id' => 'required|unique:scores',
        ]);
        $name = self::getImage($request);
        $score = self::generateScore($request);
        Score::insert([
            'rit_id' => $request->rit_id,
            'user_id' => $request->user_id,
            'cane_table' => $request->cane_table,
            'value' => $score,
            'image1' => $name['img1'],
            'image2' => $name['img2'],
        ]);
        $score_id = Score::where('cane_table', $request->cane_table)->get()->last()->id;
        foreach(Dirt::all() as $dirt){
            ScoringValue::insert([
                'score_id' => $score_id,
                'dirt_id' => $dirt->id,
                'value' => $request->{$dirt->id},
            ]);
        }
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Score::whereId($id)->update([
            'score' => $request->score,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image1 = Score::whereId($id)->get()->last()->image1;
        $image2 = Score::whereId($id)->get()->last()->image2;
        File::delete(public_path($image1));
        File::delete(public_path($image2));
        Score::whereId($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function getImage($request)
    {
        if(Score::count() == 0){
            $score_id = 0;
        }
        else {
            $score_id = (Score::get()->last()->id) + 1;
        }

        switch($request->cane_table){
            case 1 :
                $url = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 2 :
                $url = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 3 :
                $url = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 4 :
                $url = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 5 :
                $url = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.29.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
        }

        // Save Image 1
        header("Content-type: image/jpeg");
        $image = file_get_contents($url);

        // Save Image 2
        header("Content-type: image/jpeg");
        $image2 = file_get_contents($url2);

        $img1 = 'skmt/'.$score_id.'-1.jpg';
        $img2 = 'skmt/'.$score_id.'-2.jpg';

        file_put_contents($img1, $image);
        file_put_contents($img2, $image2);

        $data['img1'] = $img1;
        $data['img2'] = $img2;

        return $data;
    }

    public function generateScore($request){
        $daduk = $request->{1} * Dirt::whereId(1)->get()->last()->value / 10;
        $akar = $request->{2} * Dirt::whereId(2)->get()->last()->value / 10;
        $tali_pucuk = $request->{3} * Dirt::whereId(3)->get()->last()->value / 10;
        $pucuk = $request->{4}  * Dirt::whereId(4)->get()->last()->value / 10;
        $sogolan = $request->{5} * Dirt::whereId(5)->get()->last()->value / 10;
        $tebu_muda = $request->{6} * Dirt::whereId(6)->get()->last()->value / 10;
        $lelesan = $request->{7} * Dirt::whereId(7)->get()->last()->value / 10;
        $terbakar = $request->{8} * Dirt::whereId(8)->get()->last()->value / 10;

        $score = 100 - ($daduk + $akar + $tali_pucuk + $pucuk + $sogolan + $tebu_muda + $lelesan + $terbakar);

        switch($score){
            case($score < 1): $grade = 'G'; break;
            case($score >= 1 && $score <= 40): $grade = 'G'; break;
            case($score >= 41 && $score <= 50): $grade = 'F'; break;
            case($score >= 51 && $score <= 60): $grade = 'E'; break;
            case($score >= 61 && $score <= 70): $grade = 'D'; break;
            case($score >= 71 && $score <= 80): $grade = 'C'; break;
            case($score >= 81 && $score <= 90): $grade = 'B'; break;
            case($score >= 91 && $score <= 100): $grade = 'A'; break;
            case($score > 100): $grade = 'A'; break;
        }

        return $grade;
    }
}
