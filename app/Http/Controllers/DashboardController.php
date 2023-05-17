<?php

namespace App\Http\Controllers;

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
        
        return view('pages.dashboard', [
            'approved' => array_values($approved),
            'rejected' => array_values($rejected),
            'all' => array_values($body['data'])
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
