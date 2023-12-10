<?php

namespace App\sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ValidaClient {

    public function validateClient($data){



    
        $f = new \App\sts\Models\helper\StsFormat();

        if($data){

            $acesso = $f->onlyNumbers($data['clientIncricao']);

        }
        $consulta = new \App\sts\Models\helper\StsRead();
        $consulta->fullRead("SELECT * FROM ttlksa2010 where SA2_NUMBER_PERSON = '$acesso' LIMIT 1");
        $dados['consulta'] = $consulta->getResultado();
        if($dados['consulta']){
            extract($dados['consulta'][0]);
            $display = array(
                "error" => 0, 
                "msg" => 'Success',
                "client_hash" => $SA2_UUID, 
                "client_nm" => $SA2_NM_CORP
            );

            echo json_encode($display, true);
            exit;
            

        }else{
            
				$retorno = [
					'erro' => 9540,
					'status' => 'Erro!',
					'msg' => 'Client not register',
				];
				echo json_encode($retorno);
				exit;
        };
        
        


    }

}
