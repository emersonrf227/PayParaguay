<?php

namespace Core;

class ConfigView
{

    private $Nome;
    private $Dados;
    private $navBar;
    private $changeRdp;


    public function __construct($Nome, array $Dados = null)
    {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    public function renderizar($navBar = true, $changeRdp = false)
    {
        $this->navBar = $navBar;
        $this->changeRdp = $changeRdp;
        include 'app/sts/Views/include/cabecalho.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/sts/Views/include/rodape.php';
    }


    public function renderizarAdmin($graph = false, $title = 'Home', $active = 'home', $changeRdp = false)
    {
        $this->Graph = $graph;
        $this->changeRdp = $changeRdp;
        include 'app/sts/Views/include/cabecalho_admin.php';
        // include 'app/sts/Views/include/sidebar.php';
        // include 'app/sts/Views/include/menu.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/sts/Views/include/rodape.php';
    }

    public function renderizarLogin($changeRdp = false)
    {
        $this->changeRdp = $changeRdp;
        include 'app/sts/Views/include/cabecalho.php';

        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/sts/Views/include/rodape.php';
    }

    public function NotHeaderFooter()
    {

        // include 'app/sts/Views/include/cabecalho.php';

        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }


        // include 'app/sts/Views/include/rodape.php';
    }

    public function NotFooter()
    {
        include 'app/sts/Views/include/cabecalho.php';
        include 'app/sts/Views/include/menu.php';
        // include 'app/sts/Views/include/sidebar.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            //include 'app/sts/Views/Include/cabecalho.php';
            include 'app/' . $this->Nome . '.php';
            //include 'app/sts/Views/Include/rodape.php';

        } else {
            echo "Erro ao carrega a pagina: {$this->Nome}";
        }
    }


    public function NotAll()
    {

        if (file_exists('app/' . $this->Nome . '.php')) {
            //include 'app/sts/Views/Include/cabecalho.php';
            include 'app/' . $this->Nome . '.php';
            //include 'app/sts/Views/Include/rodape.php';

        } else {
            echo "Erro ao carrega a pagina: {$this->Nome}";
        }
    }

    public function NotMenuSidebar()
    {
        include 'app/sts/Views/include/cabecalho.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        } else {
            echo "Erro ao carrega a pagina: {$this->Nome}";
        }
        include 'app/sts/Views/include/rodape.php';
    }
}
