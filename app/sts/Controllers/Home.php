<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Home
{



    private $Dados;
    private $DataToken;


    public function dashboard()
    {
        $carregarView = new \Core\ConfigView("sts/Views/home/dashboard", $this->Dados);
        $carregarView->renderizarAdmin(false, 'DASHBOARD', 'home');
    }

    public function viewTransactions()
    {
        $carregarView = new \Core\ConfigView("sts/Views/home/viewTransactions", $this->Dados);
        $carregarView->renderizarAdmin(false, 'TRANSACTIONS', 'transaction');
    }

    public function viewReceipt()
    {
        $carregarView = new \Core\ConfigView("sts/Views/home/viewReceipt", $this->Dados);
        $carregarView->renderizarAdmin(false, 'RECEIPT', 'transaction');
    }


    public function viewUsers()
    {
        $carregarView = new \Core\ConfigView("sts/Views/home/viewUsers", $this->Dados);
        $carregarView->renderizarAdmin(false, 'USERS', 'clients');
    }
}
