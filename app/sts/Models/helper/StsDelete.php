<?php

namespace App\sts\Models\helper;

class StsDelete extends StsConn{

    private $Tabela;
    private $Termos;
    private $Values;
    private $Resultado;
    private $Query;
    private $Conn;
	private $Data;

    public function sqlResult(){
		return $this->Data;
    }

    function getResultado(){
        return $this->Resultado;
    }

    public function exeDelete($Tabela, $Termos, $ParseString){
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        parse_str($ParseString, $this->Values);

        $this->executarIntrucao();
    }

    private function executarIntrucao(){
        $this->Query = "DELETE FROM {$this->Tabela} {$this->Termos}";
        $this->conexao();

        try {
            $this->Query->execute($this->Values);
            $this->Resultado = true;
            
        } catch (Exception $ex) {
            $this->Resultado = false;
            $response["status"] = "error";
            $response["msg"] = 'Dados não deletados: ' .$ex->getMessage();
        }

        $this->Data["data"] = $response;
    }

    private function conexao(){
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }
}
