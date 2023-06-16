<?php

namespace App\Traits;
use Firebase\JWT\{JWT, Key};
use Illuminate\Support\Facades\Session;

/**
 * 
 * Decode JWT token
 */
trait DecodeJWT
{
    public function decode_jwt_token($token)
    {
        $secretKey = env('JWT_SECRET');

        // untuk decode pertama kali harus di tunda dulu biar gk error
        if (Session::get('isFirstLogin'))
        {
            sleep(2);
        }

        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }
}
