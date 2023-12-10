<?php
namespace App\sts\Models\helper;

class StsCreate extends StsConn {

   
    private $Tabela; //Receber o nome da tabela
    private $Dados; //Dados a serem inseridos no banco de dados
    private $Resultado; //Retornar o resultado
    private $Query; //Atribuilçao da query
    private $Conn; //Conexão com o banco de dados
	private $Data; //Array com status da solicitacao SQL

    public function exeCreate($Tabela, array $Dados) {
        //O atributo private $Tabela e definida com o valor pasado pelo parametro $Tabela
        $this->Tabela = (string) $Tabela;
        //O atributo private $Dados; e definido com o valor pasado pelo parametro $Dados
        $this->Dados = $Dados;
        $this->getIntrucao();
        $this->exeInstrucao();
    }

    private function getIntrucao() {
        //Busca e separa os arrays vindo do banco de dados($this->Dados)
        $colunas = implode(',', array_keys($this->Dados));
         $valores = ':' . implode(', :', array_keys($this->Dados));
        //Atribuilçao da query
        $this->Query = "INSERT INTO {$this->Tabela} ({$colunas}) VALUES ({$valores})";
    }

    private function exeInstrucao() {
        $this->conexao();
        try {
            $this->Query->execute($this->Dados);
            $this->Resultado = $this->Conn->lastInsertid();
			$affected_rows = $this->Query->rowCount();
			
			if($affected_rows >=1){
				$response["status"] = "success";
                $response["idnsert"] = $this->Conn->lastInsertid();
				$response["message"] = $affected_rows." row inserted into database ".$this->Tabela;
			}else{
				$response["status"] = "warning";
				$response["message"] = $affected_rows." row inserted into database ".$this->Tabela;
			}
        } catch (PDOException $ex) {
            $this->Resultado = null;
			$response["status"] = "error";
            $response["message"] = 'Insert into '.$this->Tabela.' Failed: ' .$ex->getMessage();
        }
        $this->Data["data"] = $response;
    }

    private function conexao() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query); 
        ini_set('default_charset', 'UTF-8'); //esta linha antes de criar a variavel conexao
        $this->Conn->query("SET NAMES utf8"); // esta linha depois dela criada.
    }
    
    public function getResultado(){
        return $this->Resultado;
		return $this->Data;
    }
	
	public function sqlResult(){
		return $this->Data;
    }

}
