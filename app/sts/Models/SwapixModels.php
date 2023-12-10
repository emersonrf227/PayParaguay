<?php

namespace App\sts\Models;

class SwapixModels
{
    private $Dados;
    private $Resultado;
    private $Chave;
    private $keySmartPay;
    private $UserSmartPay;


    public function viewCrendetials()
    {
  
        $_SESSION['hash_master'];
        $consulta = new \App\sts\Models\helper\StsRead();
        $consulta->fullRead("SELECT * FROM ttlkss1010 as a 
        inner join ttlksa2010 as b on a.sa2_num = b.sa2_num
        where  SA2_UUID = '{$_SESSION['hash_master']}' AND SS1_STATUS = 1");       
        return $consulta->getResultado();

    }



 
}
