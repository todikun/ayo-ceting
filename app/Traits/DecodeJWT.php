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
        $retry = true;
        do {
            try {
                $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
                $retry = false;
                return $decoded;
            } catch (\Exception $e) {
                //
            }
        } while ($retry);

        // try {
        //     JWT::$leeway = 5;
        //     $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
        //     return $decoded;
        // } catch (\Exception $e) {
        // }
    }
}
