<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Send
{

    private $Dados;

    public function nft($num_recibo)
    {
        $listarDashboard = new \App\sts\Models\DbDashboard();
        $this->Dados['recibo'] =  $listarDashboard->listRecibo($num_recibo);
        $carregarView = new \Core\ConfigView("sts/Views/send/nft", $this->Dados);
        $carregarView->renderizarAdmin(false);
    }
}
