<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Notificacao
{

    private $Dados;

    public function erro($codigo_erro = NULL)
    {
        if ($_SESSION['error']) {
            switch ($codigo_erro) {
                case 404:
                    $carregarView = new \Core\ConfigView("sts/Views/notificacao/error404", $this->Dados);
                    $carregarView->renderizar();
                    break;

                case 504:
                    $carregarView = new \Core\ConfigView("sts/Views/notificacao/error-timeout", $this->Dados);
                    $carregarView->renderizar();
                    break;

                default:
                    $carregarView = new \Core\ConfigView("sts/Views/notificacao/error-default", $this->Dados);
                    $carregarView->renderizar();
                    break;
            }
        } else {
            header("location: " . URL . "login/acesso");
        }
    }

    public function success($codigo_erro = NULL)
    {

        if ($_SESSION['error']) {

            $carregarView = new \Core\ConfigView("sts/Views/notificacao/success-default", $this->Dados);
            $carregarView->NotHeaderFooter();
        } else {

            header("location: " . URL . "login/acesso");
        }
    }
}
