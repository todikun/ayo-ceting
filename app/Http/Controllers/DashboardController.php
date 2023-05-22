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
    public function __invoke(Request $request)
    {
        $url = env('API_URL').'pengajuan';
        $body = get_data_api($url, $request->cookie('api_token'));

        $approved = $this->filterByStatus($body, 'approved');
        $rejected = $this->filterByStatus($body, 'rejected');

        // filter by this month
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $approvedMonth = array_filter($approved, function($item) use ($month, $year) {
            $date = Carbon::parse($item['created_at']);
            return $date->month == $month && $date->year == $year;
        });

        $rejectedMonth = array_filter($rejected, function($item) use ($month, $year) {
            $date = Carbon::parse($item['created_at']);
            return $date->month == $month && $date->year == $year;
        });
        
        return view('pages.dashboard', [
            'approved' => $approvedMonth,
            'rejected' => $rejectedMonth,
            'all' => $body['data']
        ]);
    }
    
    private function filterByStatus($data, $status)
    {
        if ($status == 'approved') {
            $result = array_filter($data['data'], function($item) {
                return $item['status'] == 'approved';
            });
        } else if ($status == 'rejected' ){
            $result = array_filter($data['data'], function($item) {
                return $item['status'] == 'rejected';
            });
        }

        return $result;
    }
}
