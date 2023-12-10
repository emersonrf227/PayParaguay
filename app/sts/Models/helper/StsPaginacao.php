<?php
namespace App\sts\Models\helper;
//include_once("StsRead.php");

class StsPaginacao{

    //Inicio da classe
    private $Link;
    private $MaxLinks;
    private $Pagina;
    private $LimiteResultado;
    private $Offset;
    private $Query;
    private $ParseString;
    private $ResultBd;
    private $Resultado;
    private $TotalPaginas;
    private $Data;

    function getOffset() {
        return $this->Offset;
    }

    function getResultado() {
        return $this->Resultado;
    }

    public function sqlResult(){
		return $this->Data;
    }

    function __construct($Link) {
        //Local host, caminho da pagina
        $this->Link = $Link;
        $this->MaxLinks = 2;
        //echo "{$link} <br><br><br>";
    }

    public function condicao($Pagina, $LimitResultado)
    {
        $this->Pagina = (int) $Pagina ? $Pagina : 1;
        $this->LimiteResultado = (int) $LimitResultado;
        $this->Offset = ($this->Pagina * $this->LimiteResultado) - $this->LimiteResultado;
    }

    public function paginacao($Query, $ParseString = null) {
        
        $this->Query = (string) $Query;
        $this->ParseString = (string) $ParseString;
        
        $contar = new \Src\helper\StsRead();
        $contar->fullRead($this->Query, $this->ParseString);
        $this->ResultBd = $contar->getResultado();
        
        /*
        echo '<pre>';
        var_dump($this->ResultBd);
        echo 'teste '.$this->LimiteResultado;
        echo '</pre>'; exit;*/

        if ($this->ResultBd[0]['num_result'] > $this->LimiteResultado) {
            $this->instrucaoPaginacao();
        } else {
            $this->Resultado = null;
        }
    }

    private function instrucaoPaginacao() {
        $this->TotalPaginas = ceil($this->ResultBd[0]['num_result'] / $this->LimiteResultado);
        if($this->TotalPaginas >= $this->Pagina){
            $this->layoutPaginacao();
        }else{
            header("Location: {$this->Link}");
        }
    }

    private function layoutPaginacao()
    {
        $this->Resultado = "<nav aria-label='paginacao'>";
        $this->Resultado .= "<ul class='pagination justify-content-center'>";
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href=\"{$this->Link}\" tabindex='-1'>Primeira</a>";
        $this->Resultado .= "</li>";
        for ($iPag = $this->Pagina - $this->MaxLinks; $iPag <= $this->Pagina - 1; $iPag ++) {
            if ($iPag >= 1) {
                $this->Resultado .= "<li class='page-item'><a class='page-link' href=\"{$this->Link}?pg={$iPag}\">$iPag</a></li>";
            }
        }

        $this->Resultado .= "<li class='page-item active'>";
        $this->Resultado .= "<a class='page-link' href='#'>{$this->Pagina} <span class='sr-only'>(current)</span></a>";
        $this->Resultado .= "</li>";

        for ($dPag = $this->Pagina + 1; $dPag <= $this->Pagina + $this->MaxLinks; $dPag ++) {
            if ($dPag <= $this->TotalPaginas) {
                $this->Resultado .= "<li class='page-item'><a class='page-link' href=\"{$this->Link}?pg={$dPag}\">$dPag</a></li>";
            }
        }
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href=\"{$this->Link}?pg={$this->TotalPaginas}\">Última</a>";
        $this->Resultado .= "</li>";
        $this->Resultado .= "</ul>";
        $this->Resultado .= "</nav>";
    }

}
