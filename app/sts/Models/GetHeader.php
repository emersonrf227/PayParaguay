<?php

namespace App\sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class GetHeader
{

    private $Dados;

    public function __construct()
    {
    }


    function validatyToken()
    {

        // Verifica se o cabeçalho "Authorization" está presente na requisição
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            // Pega o valor do cabeçalho "Authorization"
            $authorizationHeader = $_SERVER['HTTP_AUTHORIZATION'];

            // Divide o valor do cabeçalho em partes
            $parts = explode(' ', $authorizationHeader);

            // Verifica se o cabeçalho começa com "Bearer"
            if (count($parts) === 2 && strtoupper($parts[0]) === 'BEARER') {
                // O token Bearer está na segunda parte da divisão
                $accessToken = $parts[1];

                // Agora, você pode usar $accessToken como o token de acesso

                $jwt = new \App\sts\Models\helper\StsTokenJwt();

                $decodedData = $jwt->decodeToken($accessToken);

                if ($decodedData) {

                    return $decodedData;
                } else {

                    $display = array(
                        "error" => 1000,
                        "msg" => 'Invalid Token.'
                    );
                    echo json_encode($display);
                    exit;
                }

                // $dataJwt =   $jwt->decodeToken($accessToken);

                // var_dump($dataJwt);
            } else {
                $display = array(
                    "error" => 1000,
                    "msg" => 'Invalid Token.'
                );
                echo json_encode($display);
                exit;
            }
        } else {
            $display = array(
                "error" => 1001,
                "msg" => 'Token not Found.'
            );
            echo json_encode($display);
            exit;
        }
    }
}
