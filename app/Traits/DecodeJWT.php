<?php

namespace App\Traits;
use Firebase\JWT\{JWT, Key};

/**
 * 
 * Decode JWT token
 */
trait DecodeJWT
{
    public function decode_jwt_token($token)
    {
        $secretKey = env('JWT_SECRET');
        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
