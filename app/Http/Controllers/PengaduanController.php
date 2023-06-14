<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\{ConvertDate, TooltipDisplayHTML};

class PengaduanController extends Controller
{
    use ConvertDate, TooltipDisplayHTML;
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function index(Request $request)
    {
        $token = $request->cookie('api_token');
        if (request()->ajax()) {
            return $this->dataTablesPengaduan($token);
        }

        return view('pages.pengaduan.index', compact('token'));
    }

    private function dataTablesPengaduan($token)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $token);
        $result = $this->filterDataByStatus($body['data'], 'pending');
        
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
                            $html = '<span class="badge badge-secondary text-dark">'.$row->status.'</span>';
                            return $html;
                        })
                        ->addColumn('_action', function($row){

                            $html = '
                                    <div class="btn-group">

                                            <a href="'.route('pengaduan.show', $row->id).'" 
                                                class="btn btn-sm btn-secondary btn-dark btn-detail" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <button data-id="'.$row->id.'" data-nama="'.$row->user['name'].'" data-status="approve"
                                                class="btn btn-sm btn-success konfirmasi"
                                                title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>

                                            <button data-id="'.$row->id.'" data-nama="'.$row->user['name'].'" data-status="reject"
                                                class="btn btn-sm btn-danger konfirmasi"
                                                title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    
                                    ';

                            return $html;
                        })
                        ->rawColumns(['_isi_pengajuan', '_status', '_action'])
                        ->toJson();
        return $datatables;
    }

    public function show(Request $request, $id)
    {
        $url = $this->apiUrl.'pengajuan/'.$id;
        $body = get_data_api($url, $request->cookie('api_token'));
        
        return view('pages.pengaduan.show', [
            'pengajuan' => $body['data']
        ]);
    }

    public function riwayat(Request $request)
    {
        if (request()->ajax()) {
            return $this->dataTablesRiwayatPengaduan($request->cookie('api_token'));
        }
        return view('pages.pengaduan.riwayat');
    }

    private function dataTablesRiwayatPengaduan($token)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $token);
        $result = $this->filterDataByStatus($body['data']);
        
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
                            $html = '';
                            if ($row->status == 'approved') {
                                $html = '<span class="badge badge-success">'.$row->status.'</span>';
                            } else {
                                $html = '<span class="badge badge-danger">'.$row->status.'</span>';
                            }
                            return $html;
                        })
                        ->rawColumns(['_isi_pengajuan', '_status'])
                        ->toJson();
        return $datatables;
    }
    
    private function filterDataByStatus($array, $pengaduanStatus = null)
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
