<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    private $apiUrl = 'http://103.141.74.123:5000/';
    public function index(Request $request)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));
        $result = $this->filterData($body['data'], true);

        return view('pages.konsultasi.index', [
            'pengajuan' => $result
        ]);
    }

    public function recentMessage(Request $request, $pengaduanId, $userIdPengaduan)
    {
        $url = $this->apiUrl.'diskusi/'.$pengaduanId;
        $body = get_data_api($url, $request->cookie('api_token'));
        $decodedToken = decode_jwt_token($request->cookie('api_token'));
        
        return view('pages.konsultasi.form-konsultasi', [
            'message' => $body['data'] ?? null,
            'pengaduanId' => $pengaduanId,
            'loggedUser' => $decodedToken->id,
            'userIdPengaduan' => $userIdPengaduan,
            'token' => $request->cookie('api_token'),
        ]);
    }

    public function riwayatKonsultasi(Request $request)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));
        $result = $this->filterData($body['data'], false);

        return view('pages.konsultasi.riwayat', [
            'pengajuan' => $result
        ]);
    }
    
    public function riwayatKonsultasiDetail(Request $request, $id)
    {
        return 'ok';
    }

    private function filterData($array, $diskusiStatus)
    {
        $result = array_filter($array, function($item) use ($diskusiStatus) {
            return $item['status'] == 'approved' && $item['discussion_status'] == $diskusiStatus;
        });

        return array_values($result);
    }


}
