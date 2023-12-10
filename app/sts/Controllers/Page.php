<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Page
{

    private $Dados;

    public function Index()
    {
        $carregarView = new \Core\ConfigView("sts/Views/page/index", $this->Dados);
        $carregarView->renderizar(true, true);
    }

    public function checkRegister()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $pageModels = new \App\sts\Models\PageModels();
        $pageModels->getResultado($this->Dados);
    }

    public function checkDocument()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $pageModels = new \App\sts\Models\PageModels();
        $pageModels->getDocument($this->Dados);
    }



    public function confirmKyc()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $f =  new \App\sts\Models\helper\StsFormat();
        $document =   $f->onlyNumbers(addslashes($this->Dados['document']));
        $wallet =    addslashes($this->Dados['wallet']);
        $pageModels = new \App\sts\Models\PageModels();
        $return =  $pageModels->confirmKyc($wallet, $document);
        echo json_encode($return, true);
    }

    public function generateEmv()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $f =  new \App\sts\Models\helper\StsFormat();
        $uuid =   addslashes($this->Dados['uuid']);
        $brlAmount =   addslashes($this->Dados['brlAmount']);
        $pageModels = new \App\sts\Models\PageModels();
        $return =  $pageModels->generateEmv($uuid, $brlAmount);
        echo json_encode($return, true);
    }

    public function statusEmv($orderHash)
    {
        $hash =   addslashes($orderHash);
        $pageModels = new \App\sts\Models\PageModels();
        $return =  $pageModels->statusEmv($hash);
        echo json_encode($return, true);
    }
}
