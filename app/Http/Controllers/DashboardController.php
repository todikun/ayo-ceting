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
    
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function __invoke(Request $request)
    {
        $url = $this->apiUrl.'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));
        
        // filter data
        $approved = $this->filterDataByThisMonth($body['data'], 'approved', null);
        $rejected = $this->filterDataByThisMonth($body['data'], 'rejected', null);
        $pending = $this->filterDataByThisMonth($body['data'], 'pending', null);
        $all = $this->filterDataByThisMonth($body['data'], null, null);
        $diriSendiri = $this->filterDataByThisMonth($body['data'], null, 1); // 1 = diri sendiri
        $orangLain = $this->filterDataByThisMonth($body['data'], null, 2); // 2 = orang lain

        // chart
        $chart = $this->chart($body['data']);
        
        return view('pages.dashboard', compact(
            'approved', 'rejected', 'pending', 'all', 'diriSendiri', 'orangLain', 'chart')
        );
    }

    private function filterDataByThisMonth($array, $status, $kategori)
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
                $date = Carbon::parse($item['created_at']);
                return $date->month == $month && $date->year == $year && $item['category_pengajuan']['id'] == $kategori;
            });
        } else {
            $result = array_filter($array, function($item) use ($month, $year) {
                $date = Carbon::parse($item['created_at']);
                return $date->month == $month && $date->year == $year;
            });
        }

        return $result;
    }

    private function chart($data)
    {

        $month = 1; // start month
        $year = Carbon::now()->format('Y');
        $result['diri_sendiri'] = [];
        $result['orang_lain'] = [];
        
        /**
         * Perulangan untuk mengecek pengaduan tiap bulan
         */
        for ($i = 0; $i < 12; $i++) {
            $temp_diri_sendiri = array_filter($data, function($item) use($year, $month) {
                $date = Carbon::parse($item['created_at']);
                return $date->month == $month && $date->year == $year && $item['category_pengajuan']['id'] == 1;
            });
            
            $temp_orang_lain = array_filter($data, function($item) use($year, $month) {
                $date = Carbon::parse($item['created_at']);
                return $date->month == $month && $date->year == $year && $item['category_pengajuan']['id'] == 2;
            });

            array_push($result['diri_sendiri'], 
                empty($temp_diri_sendiri) ? 0 : count($temp_diri_sendiri)
            );
            
            array_push($result['orang_lain'], 
                empty($temp_orang_lain) ? 0 : count($temp_orang_lain)
            );

            $month++;
        }

        $data = [
            [
                "name" => "Diri sendiri",
                "data" => [
                    $result['diri_sendiri'][0],
                    $result['diri_sendiri'][1],
                    $result['diri_sendiri'][2],
                    $result['diri_sendiri'][3],
                    $result['diri_sendiri'][4],
                    $result['diri_sendiri'][5],
                    $result['diri_sendiri'][6],
                    $result['diri_sendiri'][7],
                    $result['diri_sendiri'][8],
                    $result['diri_sendiri'][9],
                    $result['diri_sendiri'][10],
                    $result['diri_sendiri'][11],
                ]
            ],
            [
                "name" => "Orang lain",
                "data" => [
                    $result['orang_lain'][0],
                    $result['orang_lain'][1],
                    $result['orang_lain'][2],
                    $result['orang_lain'][3],
                    $result['orang_lain'][4],
                    $result['orang_lain'][5],
                    $result['orang_lain'][6],
                    $result['orang_lain'][7],
                    $result['orang_lain'][8],
                    $result['orang_lain'][9],
                    $result['orang_lain'][10],
                    $result['orang_lain'][11],
                ]
            ]
        ];

        return $data;
    }
    
}
