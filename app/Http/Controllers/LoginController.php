<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class LoginController extends Controller
{
    
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

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
        $url = $this->apiUrl.'login';
        try {
            $response = Http::post($url, [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]);

            $body = $response->json();
            $statusCode = $body['meta']['code'];
            $roleName = $body['data']['user']['role']['role_name'] ?? null;
            $userId = $body['data']['user']['id'] ?? null;
            $name = $body['data']['user']['name'] ?? null;

            if ($statusCode === 200 && $roleName === 'Administrator') {
                $token = $body['data']['token'];
                $cookie = cookie('api_token', $token, 60 * 24);

                return redirect()->route('dashboard')
                            ->withCookie($cookie)
                            ->with(
                                [
                                    'name' => $name,
                                    'isLogin' => true,
                                ]
                            );
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
