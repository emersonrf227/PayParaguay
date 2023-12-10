<?php

namespace App\sts\Models\helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class StsTokenJwt
{
    private $key;

    public function __construct()
    {
        $this->key = '0xd07ed8cfa3b728f7179a0f589fd09bc3f393aa0fab87cfa47c6819a99ed7b125';
    }

    public function generateToken($data)
    {
        try {
            $token = JWT::encode($data, $this->key, 'HS256');
            return $token;
        } catch (\Firebase\JWT\ExpiredException $e) {
        }
    }

    public function decodeToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));

            return (array) $decoded;
        } catch (\Firebase\JWT\ExpiredException $e) {
            $display = array(
                "error" => 1000,
                "msg" => $e->getMessage()
            );
            echo json_encode($display);
            exit;
            // var_dump($e);
        }
    }
}