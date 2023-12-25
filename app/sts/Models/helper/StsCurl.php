<?php

namespace App\sts\Models\helper;

//header('Content-Type: text/html; charset=utf-8');
//require_once ('Config.php');
error_reporting(0);
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

class StsCurl
{

    public function sendApi($url, $postfild, $httpHeader, $method)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfild); // post images
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);
        $response = curl_exec($curl);
        curl_close($curl);
        $json  = json_decode($response);
        return $json;
    }

    public function sendApiNoParam($url, $postfild = null, $httpHeader = null, $method)
    {




        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        if ($postfild) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postfild);
        } // post images
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
        if ($httpHeader) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);
        }

        $response = curl_exec($curl);
        curl_close($curl);

        $json  = json_decode($response);
        return $json;
    }
}
