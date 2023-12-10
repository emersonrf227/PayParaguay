<?php
namespace App\sts\Models\helper;

class StsCampoVazio
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
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
		
        if (in_array('', $this->Dados)) {
            $_SESSION['msg'] = "<div class='col-md-6 remove_style_button_links_css alert alert-danger alert-dismissible  fade show' role='alert'>
    <p><strong>Error!</strong>Fields empty on array. empty fileds in this->Dados on StsCampoVazio.php. </p>
    <span class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </span>
</div>";
            /*
            echo '<pre>';
            print_r($this->Dados);
            echo '</pre>';
             * 
             */
            $this->Resultado = false;
        } else {
            $this->setDados($this->Dados);
        }
    }
	
	public function setDados(array $dados){
		
		foreach($dados as $key => $valida){
			if(isset($key) and !empty($key) and !is_null($key)){
				$this->Resultado = true;
			}else{
				$this->Resultado = false;
			}
		}
		
	}

}
