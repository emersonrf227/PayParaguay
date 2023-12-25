<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Invoice
{



    private $Dados;
    private $DataToken;

    // function __construct()
    // {
    //     $val =  new \App\sts\Models\GetHeader();
    //     $this->DataToken = $val->validatyToken();
    // }

    public function new()
    {
        $carregarView = new \Core\ConfigView("sts/Views/invoice/generate", $this->Dados);
        $carregarView->renderizarAdmin(false);
    }


    public function createInvoice()
    {
        $val =  new \App\sts\Models\GetHeader();
        $this->DataToken = $val->validatyToken();
        $request = file_get_contents("php://input");
        $this->Dados['data'] = json_decode($request, true);
        $invoce =  new \App\sts\Models\InvoiceModels();
        $invoce->createNewInvoice($this->DataToken, $this->Dados['data']);
    }
}
