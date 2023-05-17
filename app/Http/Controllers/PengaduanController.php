<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $url = env('API_URL').'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));
        $result = filter_data_by_status($body, 'pending');
        return view('pages.pengaduan.index', [
            'pengajuan' => $result
        ]);
    }

    public function show(Request $request, $id)
    {
        $url = env('API_URL').'pengajuan/'.$id;
        $body = get_data_api($url, $request->cookie('api_token'));
        
        return view('pages.pengaduan.show', [
            'pengajuan' => $body['data']
        ]);
    }

    public function approve(Request $request, $id)
    {
        $url = env('API_URL').'pengajuan/approve/'.$id;
        $body = put_data_api($url, $request->cookie('api_token'));
        
        if ($body['meta']['code'] === 200) {
            toastr()->success($body['meta']['message']);
        } else {
            toastr()->error($body['meta']['message']);
        }

        return redirect()->route('pengaduan.index');
    }
    
    public function reject(Request $request, $id)
    {
        $url = env('API_URL').'pengajuan/reject/'.$id;
        $body = put_data_api($url, $request->cookie('api_token'));
        
        if ($body['meta']['code'] === 200) {
            toastr()->success($body['meta']['message']);
        } else {
            toastr()->error($body['meta']['message']);
        }

        return redirect()->route('pengaduan.index');
    }

    public function riwayat(Request $request)
    {
        $url = env('API_URL').'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));
        
        $result = filter_data_by_status($body);
        return view('pages.pengaduan.riwayat', [
            'pengajuan' => $result
        ]);
    }

}
