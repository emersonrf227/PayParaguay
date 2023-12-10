<?php
namespace App\sts\Models\helper;
if(!defined("URL")){
    header("Location: /");
    exit();
}

class AdmsCampoVazioComTag
{

    private $Dados;
    private $Resultado;
    
    function getResultado()
    {
        return $this->Resultado;
    }

    
    public function validarDados(array $Dados)
    {
        $this->Dados = $Dados;
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)) {
           $_SESSION['msg'] = "<div class=' remove_style_button_links_css alert alert-danger alert-dismissible  fade show' role='alert'>
    <p><strong>Error!</strong> Fields empty on array. empty fileds in this->Dados on AdmsCampoVazioComTag.php. </p>
    <span class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </span>
</div>";
            
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
