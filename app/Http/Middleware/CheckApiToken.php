<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\DecodeJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    use DecodeJWT;
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie('api_token')) {
            $token = $request->cookie('api_token');
            $payload = $this->decode_jwt_token($token);
            $value = [
                'token' => $request->cookie('api_token'),
                'id' => $payload->id,
                'name' => $payload->name,
                'username' => $payload->username
            ];
    
            view()->share('_auth', $value);
            return $next($request);
        } else {
            return redirect('/login'); 
        }
    }
}
