<?php 

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

if (!function_exists('get_data_api')) {

    function get_data_api($url, $cookie)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cookie,
            ])->get($url);

            $body = $response->json();

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
                return 'Kesalahan server!';
            }
        }

        return $body;
    }
}

if (!function_exists('post_data_api')) {

    function post_data_api($url, $cookie, $data)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cookie,
            ])->post($url, $data);

            $body = $response->json();
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
                return 'Kesalahan server!';
            }
        }

        return $body;
    }
}

if (!function_exists('put_data_api')) {
    
    function put_data_api($url, $cookie, $data = null)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cookie,
            ])->put($url, $data);

            $body = $response->json();

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
                return 'Kesalahan server!';
            }
        }

        return $body;
    }
    
}

if (!function_exists('delete_data_api')) {
    
    function delete_data_api($url, $cookie)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cookie,
            ])->delete($url);

            $body = $response->json();

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
                return 'Kesalahan server!';
            }
        }

        return $body;
    }
    
}

if (!function_exists('filter_data_by_status')) {
    
    function filter_data_by_status($data, $status = null)
    {
        if ($status == 'pending') {
            $result = array_filter($data['data'], function($item) {
                return $item['status'] == 'pending';
            });
        } else if ($status == 'approved'){
            $result = array_filter($data['data'], function($item) {
                return $item['status'] == 'approved';
            });
        } else if ($status == 'rejected'){
            $result = array_filter($data['data'], function($item) {
                return $item['status'] == 'rejected';
            });
        } else if ($status == 'selesai'){
            $result = array_filter($data['data'], function($item) {
                return $item['status'] == 'selesai';
            });
        } else {
            $result = array_filter($data['data'], function($item) {
                return $item['status'] != 'pending';
            });
        }

        return array_values($result);
    }
}