<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestApiPdeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($rfid)
    {
        $url = 'http://192.168.20.45:8111/rfid/info/';
        $request_url = $url.$rfid;
        $curl = curl_init($request_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [ 'authorization:PGKBA2023' ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }
}
