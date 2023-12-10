<?php

namespace App\sts\Models\helper;

class StsLog{

    public function OpenArquivoLog($tipo, $informacao){

        $arqName = 'auditoria/'.$tipo.date('Y-m-d').'.txt';
        $fp1 = fopen(URL . $arqName, 'r');
        $conteudo = fread($fp1, filesize($arqName));
        $this->geraLog($conteudo, $informacao, $arqName); 
    }

    public function geraLog($conteudo,$informacao, $arquivo){

        $fp = fopen($arquivo, 'w');
        $log = $conteudo . "\r\n";
        fwrite($fp, $log);
        fwrite($fp, $informacao);
        fclose($fp);
    }

}


