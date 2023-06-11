<?php

namespace App\Http\Controllers;

use App\Traits\DecodeJWT;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class KonsultasiController extends Controller
{
    use DecodeJWT;
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->dataTablesPengaduan($request->cookie('api_token'));
        }

        return view('pages.konsultasi.index');
    }

    private function dataTablesPengaduan($token)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $token);
        $result = $this->filterData($body['data'], true);
        
        // convert to object
        $collection = collect($result);
        $object = $collection->map(function ($item) {
            return (object)$item;
        });

        $datatables = DataTables::of($object)
                        ->addIndexColumn()
                        ->editColumn('user', function($row) {
                            return $row->user['name'];
                        })
                        ->editColumn('category_pengajuan', function($row) {
                            return $row->category_pengajuan['category_name'];
                        })
                        ->editColumn('created_at', function($row) {
                            $date = Carbon::parse($row->created_at)
                                            ->locale('id')
                                            ->translatedFormat('j F Y');
                            return $date;
                        })
                        ->addColumn('_status', function($row) {
                            $html = '<span class="badge badge-success">Active</span>';
                            return $html;
                        })
                        ->addColumn('_action', function($row){

                            $html = '
                                    <div class="btn-group">

                                            <a href="'.route('konsultasi.message', ['pengaduan'=>$row->id, 'user_pengaduan'=>$row->user_id, 'name'=> $row->user['name']]).'" 
                                                class="btn btn-primary" title="Konsultasi">
                                                <i class="fas fa-comments"></i>
                                            </a>

                                    
                                    ';

                            return $html;
                        })
                        ->rawColumns(['_status', '_action'])
                        ->toJson();
        return $datatables;
    }

    public function recentMessage(Request $request)
    {
        $pengaduanId = request()->get('pengaduan');
        $userIdPengaduan = request()->get('user_pengaduan');
        $userNamePengaduan = request()->get('name');
        // $url = $this->apiUrl.'diskusi/'.$pengaduanId;
        // $body = get_data_api($url, $request->cookie('api_token'));
        $payload = $this->decode_jwt_token($request->cookie('api_token'));
        
        return view('pages.konsultasi.form-konsultasi', [
            'pengaduanId' => $pengaduanId,
            'loggedUser' => $payload->id,
            'userIdPengaduan' => $userIdPengaduan,
            'userNamePengaduan' => $userNamePengaduan
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
