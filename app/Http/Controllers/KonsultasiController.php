<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index(Request $request)
    {
        $url = env('API_URL').'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));

        $result = filter_data_by_status($body, 'approved');
        return view('pages.konsultasi.index', [
            'pengajuan' => $result
        ]);
    }

    public function recentMessage(Request $request, $id)
    {
        $url = env('API_URL').'diskusi/'.$id;
        $body = get_data_api($url, $request->cookie('api_token'));
        return view('pages.konsultasi.form-chat', [
            'message' => $body['data'],
        ]);
    }
}
