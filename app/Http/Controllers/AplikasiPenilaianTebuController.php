<?php

namespace App\Http\Controllers;

use App\Models\Rit;
use App\Models\Dirt;
use App\Models\Score;
use App\Models\ScoringValue;
use Illuminate\Http\Request;

class AplikasiPenilaianTebuController extends Controller
{
    public function meja_selatan(){
        $dirts = Dirt::all();
        $score_rit_id = Score::select('rit_id')->get();
        $rits = Rit::whereNotIn('id', $score_rit_id)->get();
        return view('aplikasi.meja_selatan', compact('rits', 'dirts'));
    }

    public function meja_utara(){
        $dirts = Dirt::all();
        $score_rit_id = Score::select('rit_id')->get();
        $rits = Rit::whereNotIn('id', $score_rit_id)->get();
        return view('aplikasi.meja_utara', compact('rits', 'dirts'));
    }

    public function proses_meja_selatan(Request $request){
        $request->validate([
            'rit_id' => 'required|unique:scores',
            'cane_table' => 'required',
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
        return redirect()->route('penilaian_meja_selatan_sukses', $score);
    }

    public function proses_meja_utara(Request $request){
        $request->validate([
            'rit_id' => 'required|unique:scores',
            'cane_table' => 'required',
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
        return redirect()->route('penilaian_meja_utara_sukses', $score);

    }

    public function penilaian_meja_selatan_sukses($score){
        return view('aplikasi.penilaian_meja_selatan_sukses', compact('score'));
    }

    public function penilaian_meja_utara_sukses($score){
        return view('aplikasi.penilaian_meja_utara_sukses', compact('score'));
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
                $url = "http://admin:qc_12345@192.168.29.103/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.29.103/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 2 :
                $url = "http://admin:qc_12345@192.168.40.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.40.32/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 3 :
                $url = "http://admin:qc_12345@192.168.40.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.40.32/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 4 :
                $url = "http://admin:qc_12345@192.168.40.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.40.32/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
            break;
            case 5 :
                $url = "http://admin:qc_12345@192.168.40.30/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
                $url2 = "http://admin:qc_12345@192.168.40.32/ISAPI/streaming/channels/1/picture?videocodec=jpeg";
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
        return 'D';
    }
}
