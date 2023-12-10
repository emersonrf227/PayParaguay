<?php
namespace App\sts\Models\helper;

class StsUpdate extends StsConn
{

    private $Tabela;
    private $Dados;
    private $Query;
    private $Conn;
    private $Resultado;
    private $Termos;
    private $Values;
	private $Data; //Array com status da solicitacao SQL
	
	public function sqlResult(){
		return $this->Data;
    }

    function getResultado()
    {
        return $this->Resultado;
    }

    public function exeUpdate($Tabela, array $Dados, $Termos = null, $ParseString = null)
    {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Values);
        $this->getIntrucao();
        $this->executarInstrucao();
    }

    private function getIntrucao()
    {
        foreach ($this->Dados as $key => $Value) {
            $Values[] = $key . '= :' . $key;
        }
        $Values = implode(', ', $Values);
        $this->Query = "UPDATE {$this->Tabela} SET {$Values} {$this->Termos}";
    }

    private function executarInstrucao()
    {
        $this->conexao();
        try {
            $this->Query->execute(array_merge($this->Dados, $this->Values));
            $this->Resultado = true;
			//verifica o numero de linhas afetadas e retorna um array com o status da consulta SQL
			$affected_rows = $this->Query->rowCount();
			if($affected_rows >=1){
				$response["status"] = "success";
				$response["message"] = $affected_rows." row updated into database";
			}else{
				$response["status"] = "warning";
				$response["message"] = $affected_rows." row(s) updated into database. No row updated";
			}
        } catch (PDOException $ex) {
            $this->Resultado = null;
			$response["status"] = "error";
            $response["message"] = "Update table {$this->Tabela} Failed: " .$ex->getMessage();
        }
        $this->Data["data"] = $response;
    }

    private function conexao()
    {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }

}
