<?php

namespace App\sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class NodeModels
{

    private $Dados;
    private $NODE_USER;
    private $NODE_PWD;
    private $NODE_URL;




    public function __construct()
    {
        $this->NODE_USER =  NODE_USER;
        $this->NODE_PWD = NODE_PWD;
        $this->NODE_URL = NODE_URL;


        if (isset($_SESSION['time_token_node'])) {

            $actualTimer = time();
            if ($actualTimer > $_SESSION['time_token_node']) {
                $this->getToken();
                return;
            }
        } else {
            $this->getToken();
        }
    }

    function getNewAddress()
    {
        $data = '';
        $header =  array(
            'Content-Type: application/json',
            "Authorization: Bearer " . $_SESSION['token_node']
        );
        $call = new \App\sts\Models\helper\StsCurl();
        try {
            $return =  $call->sendApi($this->NODE_URL . '/wallet/new-address?network=polygon', $data, $header, 'GET');
            return $return;
        } catch (Exception $e) {
            return false;
        }
    }

    function getBalance($token, $address)
    {
        $data = '';
        $header =  array(
            'Content-Type: application/json',
            "Authorization: Bearer " . $_SESSION['token_node']
        );
        $call = new \App\sts\Models\helper\StsCurl();
        try {
            $return =  $call->sendApi($this->NODE_URL . "/wallet/balance?network=polygon&currency=$token&address=$address", $data, $header, 'GET');
            return $return;
        } catch (Exception $e) {
            return false;
        }
    }

    function sendTransfer($fromAddress, $toAddress, $amount, $network, $token, $internalCode, $memo = null)
    {
        $data = json_encode(
            array(
                "from" => $fromAddress,
                "to" => $toAddress,
                "token" => "$token",
                "network" => "$network",
                "amount" => $amount,
                "memo" => $memo,
                "notification" => "https://smartgateway.io/callback/smart-checkout",
                "legacyId" => "$internalCode",
            )
        );
        $header =  array(
            'Content-Type: application/json',
            "Authorization: Bearer " . $_SESSION['token_node']
        );
        $call = new \App\sts\Models\helper\StsCurl();
        try {
            $return =  $call->sendApi($this->NODE_URL . "/wallet/transfer", $data, $header, 'POST');
            return $return;
        } catch (Exception $e) {
            return false;
        }
    }

    function viewTransaction($trasacationId)
    {
        $data = "";
        $header =  array(
            'Content-Type: application/json',
            "Authorization: Bearer " . $_SESSION['token_node']
        );
        $call = new \App\sts\Models\helper\StsCurl();
        try {
            $return =  $call->sendApi($this->NODE_URL . "/wallet/status?transactionId=$trasacationId", $data, $header, 'GET');
            return $return;
        } catch (Exception $e) {
            return false;
        }
    }





    function getToken()
    {
        $data = json_encode(array(
            "username" =>  $this->NODE_USER,
            "password" =>  $this->NODE_PWD
        ), true);
        $header =  array(
            'Content-Type: application/json'
        );
        $call = new \App\sts\Models\helper\StsCurl();
        try {
            $return =  $call->sendApi($this->NODE_URL . '/auth/login', $data, $header, 'POST');
            $_SESSION['token_node']  = $return->access_token;
            $_SESSION['time_token_node'] =  $timestampAtual = time() + 1500;
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
