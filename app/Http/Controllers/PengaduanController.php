<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $url = env('API_URL').'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));
        $result = $this->filterData($body['data'], 'pending');
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
        $urlApprove = env('API_URL').'pengajuan/approve/'.$id;
        $urlSendDiscussion = env('API_URL').'diskusi/'.$id;
        $token = $request->cookie('api_token');

        $userLogged = decode_jwt_token($token);
        $bodyApprove = put_data_api($urlApprove, $token);
        if ($bodyApprove['meta']['code'] === 200) {
            toastr()->success($bodyApprove['meta']['message']);
        } else {
            toastr()->error($bodyApprove['meta']['message']);
        }
        
        // send message to user
        $bodyDiscussion = post_data_api($urlSendDiscussion, $token, 
            [
                'to_user_id' => $bodyApprove['data']['user_id'],
                'from_user_id' => $userLogged->id,
                'isi_diskusi' => 'Halo, apa yang bisa kami bantu?',
            ]
        );

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
        
        $result = $this->filterData($body['data']);
        return view('pages.pengaduan.riwayat', [
            'pengajuan' => $result
        ]);
    }
    
    private function filterData($array, $pengaduanStatus = null)
    {
        if ($pengaduanStatus != null) {
            $result = array_filter($array, function($item) use ($pengaduanStatus) {
                return $item['status'] == $pengaduanStatus;
            });
        } else {
            $result = array_filter($array, function($item) {
                return $item['status'] != 'pending';
            });
        }

        return array_values($result);
    }

}
