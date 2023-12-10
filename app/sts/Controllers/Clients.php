<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Clients
{



    private $Dados;
    private $DataToken;


    function __construct()
    {
        $val =  new \App\sts\Models\GetHeader();
        $this->DataToken = $val->validatyToken();
    }

    public function list($page)
    {
        $dashboard  = new \App\sts\Models\ClientsModels();
        return $dashboard->listClients($page);
    }
}
