<?php

namespace App\sts\Models;

use chillerlan\QRCode\QRCode;


if (!defined('URL')) {
    header("Location: /");
    exit();
}

class InvoiceModels
{

    private $Dados;

    public function __construct()
    {
    }


    function createNewInvoice($userLogged, $data)
    {
        $getUser = new \App\sts\Models\helper\StsGetLogged();

        $f = new \App\sts\Models\helper\StsFormat();
        $openPix = new \App\sts\Models\helper\StsApiOpenPix();

        $orderHash = $f->gen_uuid();
        $user =  $getUser->getLogged($userLogged['uuid']);
        // echo "<pre>";
        // var_dump($user);
        // echo "</pre>";

        // exit;

        $json = json_encode(
            array(
                "name" => $user['name'],
                "correlationID" => $orderHash,
                "value" =>   number_format($data['value'], 0, '.', ''),
                "comment" => $data['document']
            )
        );
        $getqrCode = $openPix->getQrcode($json);
        $createInvoice = new \App\sts\Models\helper\StsCreate();

        if ($getqrCode->pixQrCode->brCode) {

            $dataOrder =  array(
                "uuid" => $orderHash,
                "document" =>  $f->onlyNumbers($data['document']),
                "email" => $data['email'],
                "accountId" => $user['accountId'],
                "bankId" => 1,
                "emv" => $getqrCode->pixQrCode->brCode,
                "bankIndentifier" => $getqrCode->pixQrCode->identifier,
                "movimentBankId" => $getqrCode->pixQrCode->paymentLinkID,
                "currency" => 'BRL',
                "status" => 'OPEN',
                "amount" => $data['value'],
            );
            $emvPng =  (new QRCode)->render($getqrCode->pixQrCode->brCode);

            $createInvoice->exeCreate("invoice", $dataOrder);
            if ($createInvoice->sqlResult()["data"]['status'] === 'success') {
                echo json_encode(array("error" => 0, "msg" => 'Success', "res" => $dataOrder, "dataImg" => $emvPng));
                exit;
            } else {
                echo json_encode(array("error" => 1, "msg" => 'Erro'));
                exit;
            }
        }
        echo json_encode(array("error" => 1, "msg" => 'Erro in geneate emv'));
        exit;
    }
}
