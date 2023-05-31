<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    private $apiUrl = 'http://103.141.74.123:5000/';

    public function __invoke(Request $request)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));

        // filter data
        $approved = $this->filterData($body['data'], 'approved', null);
        $rejected = $this->filterData($body['data'], 'rejected', null);
        $pending = $this->filterData($body['data'], 'pending', null);
        $all = $this->filterData($body['data'], null, null);
        $diriSendiri = $this->filterData($body['data'], null, 1); // 1 = diri sendiri
        $orangLain = $this->filterData($body['data'], null, 2); // 2 = orang lain
        
        return view('pages.dashboard', compact(
            'approved', 'rejected', 'pending', 'all', 'diriSendiri', 'orangLain')
        );
    }

    private function filterData($array, $status, $kategori)
    {
        $result = [];
        
        // filter by this month
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        
        if ($status != null) {
            // by status
            $result = array_filter($array, function($item) use ($month, $year, $status) {
                $date = Carbon::parse($item['created_at']);
                return $date->month == $month && $date->year == $year && $item['status'] == $status;
            });
        } else if ($kategori != null) {
            // by kategori
            $result = array_filter($array, function($item) use ($month, $year, $kategori) {
                return $item['category_pengajuan']['id'] == $kategori;
            });
        } else {
            $result = array_filter($array, function($item) use ($month, $year) {
                $date = Carbon::parse($item['created_at']);
                return $date->month == $month && $date->year == $year;
            });
        }

        return $result;
    }
    
    private function filterByKategori($data, $kategori)
    {
        if ($kategori == 1) {
            $result = array_filter($data['data'], function($item) {
                return $item['category_pengajuan']['id'] == 1;
            });
        } else if ($kategori == 2 ){
            $result = array_filter($data['data'], function($item) {
                return $item['category_pengajuan']['id'] == 2;
            });
        }

        return $result;
    }
}
