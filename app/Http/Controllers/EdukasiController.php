<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class EdukasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url = env('API_URL').'edukasi';
        $body = get_data_api($url, $request->cookie('api_token'));

        return view('pages.edukasi.index', [
            'puskesmas' => $body['data']['puskesmas'] ?? '',
            'edukasi' => $body['data']['edukasi'] ?? [],
        ]);
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

        $url = env('API_URL').'edukasi';
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
    public function show(Request $request, $id)
    {
        $url = env('API_URL').'edukasi/'.$id;
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
        $url = env('API_URL').'edukasi/'.$id;
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

        $url = env('API_URL').'edukasi/'.$id;
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
        $url = env('API_URL').'edukasi/'.$id;
        $body = delete_data_api($url, $request->cookie('api_token'));
        
        if ($body['meta']['code'] === 200) {
            toastr()->success($body['meta']['message']);
        } else {
            toastr()->error($body['meta']['message']);
        }
        
        return redirect()->route('edukasi.index');
    }
}
