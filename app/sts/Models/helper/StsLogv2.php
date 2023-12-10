<?php

namespace App\sts\Models\helper;

class StsLogv2{

    public function OpenArquivoLog($tipo, $informacao, $formato, $caminho = null)
    {

        if ($caminho) {
            $arqName =  $caminho . $tipo . date('Y-m-d') . '.' . $formato;
        } else {
            $arqName = 'auditoria/' . $tipo . date('Y-m-d') . '.' . $formato;
        }


        $fp1 = fopen($arqName, 'r');
        $conteudo = fread($fp1, filesize($arqName));

        if ($conteudo) {

            $dados =  json_decode($conteudo);
        } else {

            $dados =  array();
        }

        array_push($dados, json_decode($informacao));
        $informacao = json_encode($dados);


        $this->geraLog($conteudo, $informacao, $arqName);
    }

    public function geraLog($conteudo, $informacao, $arquivo)
    {
        //echo $conteudo;
        unlink($arquivo);
        $fp = fopen($arquivo, 'w');
        $log = $conteudo;
        fwrite($fp, $informacao);
        fclose($fp);
    }

}


