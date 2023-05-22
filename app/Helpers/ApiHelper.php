<?php 

use Firebase\JWT\{JWT, Key};
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

if (!function_exists('get_data_api')) {

    function get_data_api($url, $token)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
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

    function post_data_api($url, $token, $data)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
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
    
    function put_data_api($url, $token, $data = null)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
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
    
    function delete_data_api($url, $token)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
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

if (!function_exists('decode_jwt_token')) {
    
    function decode_jwt_token($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}