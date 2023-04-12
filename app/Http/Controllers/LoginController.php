<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->hasCookie('api_token')) {
            return redirect('/');
        } else {
            return view('auth.login');
        }
    }

    public function loginProses(Request $request)
    {
        $url = 'http://103.134.154.169:5000/login';
        try {
            $response = Http::post($url, [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            $body = $response->json();
            if ($body['meta']['code'] == 200 && $body['data']['user']['role_id'] == 8) {
                $token = $body['data']['token'];
                $cookie = cookie('api_token', $token, 60*24);
                return redirect('/')->withCookie($cookie); 
            } else {
                toastr()->error($body['meta']['message']);
                return redirect()->route('login');
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
                return 'Kesalahan server!';
            }
        }
    }

    public function logout()
    {
        $forget_cookie = cookie()->forget('api_token');
        $redirect = redirect()->route('login')->withCookie($forget_cookie);
        return $redirect;
    }
}
