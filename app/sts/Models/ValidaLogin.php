<?php

namespace App\sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ValidaLogin
{

    private $Dados;
    private $Resultado;
    static $NowLogin;

    public function __construct()
    {
    }

    function getResultado()
    {
        return $this->Resultado;
    }


    public function acesso($Dados)
    {


        $this->Dados['form_login'] = $Dados;
        $f = new \App\sts\Models\helper\StsFormat();
        if ($this->validarDados()) {



            $login = $f->removerAcentos($f->htmlspecialchars_recursive($this->Dados['form_login']["login"]));
            $validaLogin = new \App\sts\Models\helper\StsRead();
            $validaLogin->fullRead("SELECT * FROM authentication as a 
            inner join users as b on a.id = b.authenticationId 
            where username = '$login'");
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


            $issuedAt = time();
            $expirationTime = $issuedAt + $timerToken;
            $data = [
                'iat' => $issuedAt,
                'exp' => $expirationTime,
                'uuid' => $hash,
                'username' => $name,
                'super' => $superAdmin,
                'forceReset' => $forceReset,
            ];
            $jwt = new \App\sts\Models\helper\StsTokenJwt();
            $access_token =   $jwt->generateToken($data);

            $display = array(
                "error" => 0,
                "data" => $data,
                "access_token" => $access_token
            );
            echo json_encode($display, true);
            exit;
        } else {

            $display = array(
                "error" => 1900,
                "msg" => 'Authencation Failed.'
            );
            echo json_encode($display, true);
            exit;
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
}
