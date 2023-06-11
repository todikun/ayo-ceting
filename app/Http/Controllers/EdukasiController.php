<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class EdukasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }
    
    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->dataTables($request->cookie('api_token'));
        }
        return view('pages.edukasi.index');
    }

    
    private function dataTables($token)
    {
        $url = $this->apiUrl.'edukasi/puskesmas';
        $transactions = get_data_api($url, $token);
        
        // convert to object
        $collection = collect($transactions['data']['edukasi']);
        $object = $collection->map(function ($item) {
            return (object)$item;
        });

        $datatables = DataTables::of($object)
                        ->addIndexColumn()
                        ->editColumn('created_at', function($row) {
                            $date = Carbon::parse($row->created_at)
                                            ->locale('id')
                                            ->translatedFormat('j F Y');
                            return $date;
                        })
                        ->addColumn('_action', function($row){

                            $html = '
                            <div class="btn-group">

                                    <a href="'.route('edukasi.show', $row->slug).'"
                                        class="btn btn-sm btn-secondary btn-dark" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="'.route('edukasi.edit', $row->slug).'" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </div>
                            
                            ';

                            return $html;
                        })
                        ->rawColumns(['_action'])
                        ->toJson();
        return $datatables;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.edukasi.create');
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
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $url = $this->apiUrl.'edukasi';
        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
        ];

        $body = post_data_api($url, $request->cookie('api_token'), $data);
        
        if ($body['meta']['code'] === 200) {
            toastr()->success($body['meta']['message']);
        } else {
            toastr()->error($body['meta']['message']);
        }

        return redirect()->route('edukasi.index'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $url = $this->apiUrl.'edukasi/'.$slug;
        $body = get_data_api($url, $request->cookie('api_token'));

        return view('pages.edukasi.show', [
            'edukasi' => $body['data'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $url = $this->apiUrl.'edukasi/'.$id;
        $body = get_data_api($url, $request->cookie('api_token'));

        return view('pages.edukasi.edit', [
            'edukasi' => $body['data'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $url = $this->apiUrl.'edukasi/'.$id;
        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
        ];

        $body = put_data_api($url, $request->cookie('api_token'), $data);
        
        if ($body['meta']['code'] === 200) {
            toastr()->success($body['meta']['message']);
        } else {
            toastr()->error($body['meta']['message']);
        }

        return redirect()->route('edukasi.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $url = $this->apiUrl.'edukasi/'.$id;
        $body = delete_data_api($url, $request->cookie('api_token'));
        
        if ($body['meta']['code'] === 200) {
            toastr()->success($body['meta']['message']);
        } else {
            toastr()->error($body['meta']['message']);
        }
        
        return redirect()->route('edukasi.index');
    }
}
