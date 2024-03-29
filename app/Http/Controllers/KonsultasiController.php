<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Traits\{ConvertDate, DecodeJWT, TooltipDisplayHTML};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KonsultasiController extends Controller
{
    use ConvertDate, DecodeJWT, TooltipDisplayHTML;
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->dataTablesKonsultasi($request->cookie('api_token'));
        }

        return view('pages.konsultasi.index');
    }

    private function dataTablesKonsultasi($token)
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
                            return $this->convertDate($row->created_at);
                        })
                        ->addColumn('_isi_pengajuan', function($row) {
                            return $this->tooltipDisplayHTML($row->isi_pengajuan);
                        })
                        ->addColumn('_status', function($row) {
                            $html = '<span class="badge badge-success">Active</span>';
                            return $html;
                        })
                        ->addColumn('_action', function($row){

                            $html = '
                                    <div class="btn-group">            

                                        <form method="POST" action="'.route('konsultasi.message').'">
                                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                                            <input type="hidden" name="id_pengaduan" value="'.$row->id.'" />
                                            <input type="hidden" name="user_id_pengaduan" value="'.$row->user_id.'" />
                                            <input type="hidden" name="user_name_pengaduan" value="'.$row->user['name'].'" />
                                            <button type="submit" class="btn btn-primary" title="Konsultasi">
                                                <i class="fas fa-comments"></i>
                                            </button>
                                        </form>

                                    </div>

                                    ';

                            return $html;
                        })
                        ->rawColumns(['_isi_pengajuan', '_status', '_action'])
                        ->toJson();
        return $datatables;
    }

    public function recentMessage(Request $request)
    {   
        return view('pages.konsultasi.form-konsultasi', [
            'pengaduanId' => $request->id_pengaduan,
            'userIdPengaduan' => $request->user_id_pengaduan,
            'userNamePengaduan' => $request->user_name_pengaduan,
        ]);
    }

    public function riwayatKonsultasi(Request $request)
    {
        $url = $this->apiUrl.'pengajuan';
        if (request()->ajax()) {
            return $this->dataTablesRiwayatKonsultasi($request->cookie('api_token'));
        }

        return view('pages.konsultasi.riwayat');
    }
    
    private function dataTablesRiwayatKonsultasi($token)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $token);
        $result = $this->filterData($body['data'], false);
        
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
                        ->addColumn('_isi_pengajuan', function($row) {
                            return $this->tooltipDisplayHTML($row->isi_pengajuan);
                        })
                        ->addColumn('_vonis_awal', function($row) {
                            return $this->tooltipDisplayHTML($row->vonis_awal['vonis']);
                        })
                        ->editColumn('created_at', function($row) {
                            return $this->convertDate($row->created_at);
                        })
                        ->addColumn('_action', function($row){

                            $html = '
                            <div class="btn-group">
                                <a href="'.route('konsultasi.riwayat.detail', $row->id).'"
                                    class="btn btn-sm btn-secondary btn-dark" title="Konsultasi">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>

                            ';

                            return $html;
                        })
                        ->rawColumns(['_isi_pengajuan', '_vonis_awal', '_action'])
                        ->toJson();
        return $datatables;
    }
    
    public function riwayatKonsultasiDetail(Request $request, $id)
    {
        $url = $this->apiUrl.'pengajuan/'.$id;
        $body = get_data_api($url, $request->cookie('api_token'));
        
        return view('pages.konsultasi.riwayat-detail', [
            'pengajuan' => $body['data'],
                'pengaduanId' => $body['data']['id'],
                'userIdPengaduan' => $body['data']['user_id'],
                'userNamePengaduan' => $body['data']['user']['name'],
        ]);
    }

    private function filterData($array, $diskusiStatus)
    {
        $result = array_filter($array, function($item) use ($diskusiStatus) {
            return $item['status'] == 'approved' && $item['discussion_status'] == $diskusiStatus;
        });

        return array_values($result);
    }


}
