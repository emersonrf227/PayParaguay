<?php
//
namespace App\sts\Models\helper;

use PDO;

class StsRead extends StsConn {

    //Inicio da classe
    private $Select;
    private $Values;
    private $Resultado;
    private $Query;
    private $Conn;
	private $Data;

    function getResultado() {
        return $this->Resultado;
    }
	
	public function sqlResult(){
		return $this->Data;
    }

    public function exeRead($Tablela, $Termos = null, $ParseString = null) {
        if (!empty($ParseString)) {
            parse_str($ParseString, $this->Values);
        }
        $this->Select = "SELECT * FROM {$Tablela} {$Termos}";
        //echo "{$this->Select}";
        $this->exeInstrucao();
    }
    
    public function fullRead($Query, $ParseString = null)
    {
        $this->Select = (string) $Query;
        if (!empty($ParseString)) {
            parse_str($ParseString, $this->Values);
        }
        $this->exeInstrucao();
    }

    private function exeInstrucao() {
        $this->conexao();

        try {
            $this->GetInstrucao();
            $this->Query->execute();
            $this->Resultado = $this->Query->fetchALL();
			if(count($this->Resultado)<=0){
                $response["status"] = "warning";
                $response["msg"] = "Nenhum dado encontrado.";
            }else{
                $response["status"] = "success";
                $response["msg"] = "Dados selecionados da database";
            }
           
        } catch (PDOException $ex) {
            $this->Resultado = null;
			$response["status"] = "error";
            $response["msg"] = 'Dados não selecionados: ' .$ex->getMessage();
            
        }
        $this->Data["data"] = $response;
    }

    private function conexao() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Select);
        $this->Query->setFetchMode(PDO::FETCH_ASSOC);
               ini_set('default_charset', 'UTF-8'); //esta linha antes de criar a variavel conexao
$this->Conn->query("SET NAMES utf8"); // esta linha depois dela criada.
    }

    private function GetInstrucao() {
        if ($this->Values) {
            foreach ($this->Values as $Link => $Valor) {
                if ($Link == 'limit' || $Link == 'offset') {
                    $Valor = (int) $Valor;
                }
                $this->Query->bindValue(":{$Link}", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }

}
