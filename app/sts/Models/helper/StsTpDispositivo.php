<?php
namespace App\sts\Models\helper;

class StsTpDispositivo
{


    public function verficaMob()
    {

        $iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            
            return true;

        } else {

            return false;
        }
    }
}
