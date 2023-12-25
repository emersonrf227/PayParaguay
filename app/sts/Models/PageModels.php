<?php

namespace App\sts\Models;

use chillerlan\QRCode\QRCode;
use Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class PageModels
{

    private $Dados;
    private $NODE_USER;
    private $NODE_PWD;
    private $NODE_URL;
    private $SMARTPAY_URL;
    private $SMARTPAY_USER;
    private $SMARTPAY_PWD;






    public function __construct()
    {
        $this->NODE_USER =  NODE_USER;
        $this->NODE_PWD = NODE_PWD;
        $this->NODE_URL = NODE_URL;
        $this->SMARTPAY_URL = SMARTPAY_URL;
        $this->SMARTPAY_USER = SMARTPAY_USER;
        $this->SMARTPAY_PWD = SMARTPAY_PWD;
    }

    function confirmKyc($address, $document)
    {

        $data = '';
        $header =  array(
            'Content-Type: application/json',
        );
        $call = new \App\sts\Models\helper\StsCurl();
        try {
            $return =  $call->sendApi($this->SMARTPAY_URL . "kyc/isverified?address_from=$document&chain_from=pix&address_to=$address&chain_to=polygon", $data, $header, 'GET');
            return $return->data;
        } catch (Exception $e) {
            return false;
        }
    }

    function getDocument($form)
    {
        header('Content-Type: application/json; charset=utf-8');
        $f =  new \App\sts\Models\helper\StsFormat();
        $document =   $f->onlyNumbers(addslashes($form['document']));
        if (!$f->validaDocument($document)) {
            $display = array(
                "error" => 1010,
                "msg" => "Documento é inválido."
            );
            echo json_encode($display, true);
            return;
        }

        $viewDb = new \App\sts\Models\helper\StsRead();
        $viewDb->fullRead("SELECT *, a.uuid as uuid_user FROM `users` as a INNER JOIN wallets as b on a.id = b.userId  where a.document = '$document' ORDER BY a.id DESC LIMIT 1");
        if ($viewDb->getResultado()) {
            extract($viewDb->getResultado()[0]);

            $kyc = $this->confirmKyc($wallet, $document);
            $display = array(
                "error" => 0,
                "msg" => "Realizado com sucesso.",
                "res" => array("uuid" => $uuid_user, "name" =>  $name, "phone" => $phone, "document" => $document, "email" => $email, "wallet" => $wallet, "kyc" => $kyc),
            );
            echo json_encode($display, true);
            return;
        } else {
            $display = array(
                "error" => 1872,
                "msg" => "Document not found",
            );
            echo json_encode($display, true);
            return;
        }
    }









    function getResultado($form)
    {
        header('Content-Type: application/json; charset=utf-8');
        $f =  new \App\sts\Models\helper\StsFormat();

        $document =   $f->onlyNumbers(addslashes($form['document']));
        $name = ucwords(strtolower($f->removerAcentos(addslashes($form['name']))));
        $phone =    $f->onlyNumbers(addslashes($form['phone']));
        $email = strtolower(addslashes($form['email']));

        if (!$f->valEmail($email)) {
            $display = array(
                "error" => 1010,
                "msg" => "E-mail inválido."
            );
            echo json_encode($display, true);
            return;
        }

        if (!$f->validaDocument($document)) {
            $display = array(
                "error" => 1010,
                "msg" => "Documento é inválido."
            );
            echo json_encode($display, true);
            return;
        }

        $viewDb = new \App\sts\Models\helper\StsRead();
        $viewDb->fullRead("SELECT *, a.uuid as uuid_user FROM `users` as a INNER JOIN wallets as b on a.id = b.userId  where a.document = '$document' ORDER BY a.id DESC LIMIT 1");
        if ($viewDb->getResultado()) {
            extract($viewDb->getResultado()[0]);

            $kyc = $this->confirmKyc($wallet, $document);
            $display = array(
                "error" => 0,
                "msg" => "Realizado com sucesso.",
                "res" => array("uuid" => $uuid_user, "name" =>  $name, "phone" => $phone, "document" => $document, "email" => $email, "wallet" => $wallet, "kyc" => $kyc),
            );
            echo json_encode($display, true);
            return;
        }

        $node = new \App\sts\Models\NodeModels();
        $newAddress =  $node->getNewAddress();
        $client_address = $newAddress->res->address->address;
        if ($client_address) {
            $user_uuid = $f->gen_uuid();
            $createUser = new \App\sts\Models\helper\StsCreate();
            $createUser->exeCreate("users", array('uuid' =>  $user_uuid, 'name' => $name, 'document' => $document,  'phone' => $phone, 'email' => $email));
            $id_user = $createUser->getResultado();
            if ($id_user) {
                $createWallet = new \App\sts\Models\helper\StsCreate();
                $createWallet->exeCreate("wallets", array('uuid' => $f->gen_uuid(), 'wallet' => $client_address, 'userId' => $id_user));


                if ($createWallet->getResultado()) {
                    $kyc = $this->confirmKyc($wallet, $document);
                    $display = array(
                        "error" => 0,
                        "msg" => "Realizado com sucesso.",
                        "res" => array("uuid" => $user_uuid, "name" =>  $name, "phone" => $phone, "document" => $document, "email" => $email, "wallet" => $client_address, "kyc" => $kyc),
                    );
                    echo json_encode($display, true);
                    return;
                } else {
                    $display = array(
                        "error" => 1011,
                        "msg" => "Ocorreu um erro, tente novamente mais tarde.",
                    );
                    echo json_encode($display, true);
                    return;
                }
            }
        } else {
            $display = array(
                "error" => 1012,
                "msg" => "Ocorreu um erro, tente novamente mais tarde.",
            );
            echo json_encode($display, true);
            return;
        }




        // $validaLogin->fullRead("SELECT * FROM account
        // where username = '$login'");
    }

    public function generateEmv($uuid, $brlAmount)
    {



        $f = new \App\sts\Models\helper\StsFormat();
        $viewDb = new \App\sts\Models\helper\StsRead();
        $viewDb->fullRead("SELECT *, a.uuid as uuid_user, a.id as userId FROM `users` as a INNER JOIN wallets as b on a.id = b.userId  where a.uuid = '$uuid'");

        if ($viewDb->getResultado()) {

            extract($viewDb->getResultado()[0]);




            $data = array(
                "chain" => "polygon",
                "address" => $wallet,
                "currency" => "pxusdt",
                "amount" => $brlAmount,
                "expire" => "600",
                "amount_direction" => "in",
                "notify" => $email,
                "callback" => "https://smartgateway.io/callback/smart-checkout"
            );

            // var_dump($data);

            $api = new \App\sts\Models\helper\StsApiSmartpay($this->SMARTPAY_USER, $this->SMARTPAY_PWD, 'https://connect.smartpay.com.vc/api');

            $return  = $api->sendApi('swapix/pixlink', $data);
            if ($return["status"] == 'ok') {
                $uuid = $f->gen_uuid();
                $data['order'] = array(
                    "uuid" => $uuid,
                    "emv" => $return['data']['emv'],
                    "address" => $return['data']['address'],
                    "txid" => $return['data']['txid'],
                    "operation_type" => $return['data']["operation"]['operation_type'],
                    "curout" => $return['data']['operation']['curout'],
                    "curbase" => $return['data']['operation']['curout'],
                    "curconv" =>  $return['data']['operation']['curconv'],
                    "curin" => $return['data']['operation']['curin'],
                    "nfe" => $return['data']['operation']['nfe'],
                    "user" => $return['data']['operation']['user'],
                    "operation_id" => $return['data']['operation']['operation_id'],
                    "amount_brl" => $return['data']['operation']['rate']['amount_brl'],
                    "price_usd" => $return['data']['operation']['rate']['price_usd'],
                    "total_brl" => $return['data']['operation']['rate']['total_brl'],
                    "send_usd" => $return['data']['operation']['rate']['send_usd'],
                    "fee_brl" => $return['data']['operation']['rate']['fee_brl'],
                    "profile" => $return['data']['operation']['profile'],
                    "name" => $name,
                    "phone" => $phone,
                    "document" => $document,
                    "email" => $email,
                    "valueDeposit" => $brlAmount,
                    "addressWallet" => $wallet,
                    "created" => date('Y-m-d H:i:s'),
                    "active" => 1,
                    "status" => 'open',
                    "userId" => $userId
                );

                $createOrder = new \App\sts\Models\helper\StsCreate();
                $createOrder->exeCreate("ordem", $data['order']);
                if ($createOrder->sqlResult()['data']['status'] === 'success') {

                    $emvPng =  (new QRCode)->render($return['data']['emv']);
                    $display = array(
                        "error" => 0,
                        "msg" => 'Realizado com sucesso',
                        "res" => array(
                            "emv" => $return['data']['emv'],
                            "qrcode" =>  $emvPng,
                            "uuid" => $uuid
                        ),
                    );

                    return $display;
                } else {
                    $display = array(
                        "error" => 1019,
                        "msg" => 'Internal Server Error - 1019',
                    );

                    return $display;
                }
            }
        } else {
            $display = array(
                "error" => 1018,
                "msg" => 'User not found. - 1018',
            );

            return $display;
        }
    }

    public function statusEmv($hash)
    {
        $consultaOrdem = new \App\sts\Models\helper\StsRead();
        $consultaOrdem->fullRead("SELECT * from ordem where hash = '$hash'");
        if ($consultaOrdem->getResultado()[0]) {
            extract($consultaOrdem->getResultado()[0]);
            $curl = new \App\sts\Models\helper\StsCurl();
            $response = $curl->sendApiNoParam("https://connect.smartpay.com.vc/api/swapix/opstatus?operation_id=$operation_id", NULL, NULL, 'GET');
            if ($response) {
                $display = array(
                    "error" => 0,
                    "msg" => 'Consulta Realizada',
                    "res" =>  $response,
                    "timer" => $updateAt
                );
                return $display;
            }
        } else {
            $display = array(
                "error" => 2092,
                "msg" => "Ordem não localizada, por favor entre em contato com suporte e informe a hash : $hash"
            );

            return $display;
        }
    }


    public function statusEmvInternal($operation_id)
    {
        $consultaOrdem = new \App\sts\Models\helper\StsRead();

        $curl = new \App\sts\Models\helper\StsCurl();
        $response = $curl->sendApiNoParam("https://connect.smartpay.com.vc/api/swapix/opstatus?operation_id=$operation_id", NULL, NULL, 'GET');
        if ($response) {
            return $response;
        }
    }


    public function acesso(array $Dados)
    {
        $this->Dados['form_login'] = $Dados;
        $f = new \App\sts\Models\helper\StsFormat();
        if ($this->validarDados()) {

            $login = $f->removerAcentos($f->htmlspecialchars_recursive($this->Dados['form_login']["login"]));




            $this->Resultado = $validaLogin->getResultado();
            $this->Dados['listuser'] = $validaLogin->getResultado();
            if (!empty($this->Resultado)) {
                $this->validaAcesso();
            } else {
                $_SESSION['error'] =
                    [
                        'destroy_session' => 'S',
                        'msg' => 'Login incorreto.<br>Volte à tela de login e tente novamente.',
                        'button' => 'Voltar à tela de login',
                        'redirect' => 'login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
                    ];


                header("location: " . URL . "notificacao/erro");
                exit;
                $this->Resultado = false;
            }
        }
    }

    private function validarDados()
    {


        $this->Dados['form_login'] = array_map('strip_tags', $this->Dados['form_login']);
        $this->Dados['form_login'] = array_map('trim', $this->Dados['form_login']);

        if (in_array('', $this->Dados['form_login'])) {

            $_SESSION['error'] =
                [
                    'destroy_session' => 'S',
                    'msg' => 'Por favor, preencha todos os campos obrigatórios.',
                    'button' => 'Voltar à tela de login',
                    'redirect' => 'login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
                ];

            header("location: " . URL . "notificacao/erro");
            exit;
        } else {
            return true;
        }
    }

    private function validarSenha()
    {
        if (password_verify($this->Dados['form_login']['senha'], $this->Resultado[0]['password'])) {
            extract($this->Dados['listuser'][0]);

            $_SESSION['hash_master'] = $hash;
            $_SESSION['username'] = $name;
            $_SESSION['super'] = $superAdmin;
            $_SESSION['forceReset'] = $forceReset;
            $this->Resultado = true;
        } else {



            $_SESSION['error'] =
                [
                    'destroy_session' => 'S',
                    'msg' => 'Login incorreto.<br>Volte à tela de login e tente novamente.',
                    'button' => 'Voltar à tela de login',
                    'redirect' => 'login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
                ];

            header("location: " . URL . "notificacao/erro");
            exit;
            $this->Resultado = false;
        }
    }

    private function validaAcesso()
    {

        switch ($this->Dados['listuser'][0]['active']) {
            case '1':
                $this->validarSenha();
                break;
            case '0':
                $_SESSION['error'] =
                    [
                        'destroy_session' => 'S',
                        'msg' => 'Cadastro inativo.<br>Caso tenha interesse em reativar sua conta, entre em contato com o nosso suporte.',
                        'button' => 'Voltar à tela de login',
                        'redirect' => 'login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
                    ];
                header("location: " . URL . "notificacao/erro");
                exit();
                break;
        }
    }

    private function notificacaoLogin()
    {

        $data = date('d/m/Y H:i:s');

        $cont_email = "HTML valida login";


        $ps = new \App\sts\Models\helper\StsLog();
        $ps->OpenArquivoLog('Login', "{$_SESSION['login']['codigo_usuario']} {$_SESSION['login']['nome']} {$this->Dados['nowlogin']['nowlogin']}");
    }
}
