<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Dashboard
{



    private $Dados;
    private $DataToken;


    function __construct()
    {
    }

    public function getData()
    {
        $val =  new \App\sts\Models\GetHeader();
        $this->DataToken = $val->validatyToken();
        $dashboard  = new \App\sts\Models\DbDashboard();
        return $dashboard->getDataDashboard();
    }



    public function index()
    {
        $carregarView = new \Core\ConfigView("sts/Views/home/dashboard", $this->Dados);
        $carregarView->renderizarAdmin(false);
    }

    public function sair()
    {

        $_SESSION['error'] =
            [
                'destroy_session' => 'S',
                'msg' => 'Obrigado pela sua visita!',
                'button' => 'Voltar à tela de login',
                'redirect' => 'login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
            ];


        header("location: " . URL . "notificacao/success");
        exit;
    }
}
