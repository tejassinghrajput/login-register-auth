<?php
// app/Filters/JWTAuth.php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class JWTAuth implements FilterInterface{
    
    public function before(RequestInterface $request, $arguments = null){
        $secretKey = JWT_SECRET_KEY;
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON(['message' => 'Authorization header is missing']);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            $request->userData = (array) $decoded;
            
        } catch (\Exception $e) {
            
            return Services::response()
                ->setStatusCode(401)
                ->setJSON(['message' => 'Invalid token: ' . $e->getMessage()]);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}
