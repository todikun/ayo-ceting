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
    
    function put_data_api($url, $cookie, $data)
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