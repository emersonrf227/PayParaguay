<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Transactions
{



    private $Dados;
    private $DataToken;


    function __construct()
    {
        $val =  new \App\sts\Models\GetHeader();
        $this->DataToken = $val->validatyToken();
    }

    public function receipt()
    {
        $uuid = addslashes($_GET['uuid']);

        $receipt  = new \App\sts\Models\TransactionsModels();
        return $receipt->getReceipt($uuid);
    }

    public function list()
    {
        $page = addslashes($_GET['page']);
        $query = '';
        if (!empty($_GET['datei'])) {
            $datei = addslashes($_GET['datei']);
            $query .= " and created BETWEEN '$datei 00:00:00'";
            if (!isset($_GET['datef'])) {
                $datef = addslashes($_GET['datei']);
                $query .=  " and '$datef 23:59:59' ";
            }
        }
        if (!empty($_GET['datef'])) {
            $datef = addslashes($_GET['datef']);
            $query .= " and '$datef 23:59:59' ";
        }
        if (!empty($_GET['statusFil'])) {
            $statusFil = addslashes($_GET['statusFil']);
            $query .= "and  status = '$statusFil'";
        } else {
            $query .= "and  status = 'done'";
        }
        $transactions  = new \App\sts\Models\TransactionsModels();
        return $transactions->listTransaction($page, $query);
    }
}
