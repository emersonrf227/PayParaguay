<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Cron
{

    private $Dados;


    public function checkPayments()
    {
        $moviment = new \App\sts\Models\MovimentModels();
        return $moviment->checkPayments();
    }

    public function createForward()
    {
        $moviment = new \App\sts\Models\MovimentModels();
        return $moviment->createForward();
    }

    public function sendGasNew()
    {
        $moviment = new \App\sts\Models\MovimentModels();
        return $moviment->sendGasNew();
    }

    public function sendForward()
    {
        $moviment = new \App\sts\Models\MovimentModels();
        return $moviment->sendForward();
    }


    public function confirmForward()
    {
        $moviment = new \App\sts\Models\MovimentModels();
        return $moviment->confirmForward();
    }
}
