<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Config\JWT as JWTConfig;

class PdfTokenController extends ResourceController
{
    public function getToken()
    {
        $config = new JWTConfig();

        $payload = [
            'iss' => $config->issuer,
            'aud' => $config->audience,
            'iat' => $config->issuedAt,
            'nbf' => $config->notBefore,
            'exp' => $config->expiration,
            'data' => [
                'userId' => 1 // Contoh data yang dapat dimasukkan ke token
            ]
        ];

        $token = JWT::encode($payload, $config->key, 'HS256');

        return $this->respond(['token' => $token]);
    }
}
