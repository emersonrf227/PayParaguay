<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
  header("Location: /");
  exit();
}

class Login
{

  private $Dados;




  // public function newToken()
  // {
  //   $this->Dados['SendLogin'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  //   $login = new \App\sts\Models\ValidaLogin();
  //   return $login->newToken($this->Dados['SendLogin'], 20);
  // }


  public function acesso()
  {


    $this->Dados['SendLogin'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($this->Dados['SendLogin'])) {
      $login = new \App\sts\Models\ValidaLogin();
      $login->acesso($this->Dados['SendLogin']);
      unset($this->Dados['SendLogin']);
      if ($login->getResultado()) {
        $url = URL . 'dashboard/index';
        header("Location: $url");
        exit;
      } else {
        $this->Dados['form'] = $this->Dados;
      }
    }

    $carregarView = new \Core\ConfigView("sts/Views/login/acesso", $this->Dados);
    $carregarView->renderizarLogin(false);
  }



  public function auth()
  {

    $this->Dados['SendLogin'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $login = new \App\sts\Models\ValidaLogin();
    return  $login->acesso($this->Dados['SendLogin']);
    // if ($login->getResultado()) {
    //   $url = URL . 'dashboard/index';
    //   header("Location: $url");
    //   exit;
    // } else {
    //   $this->Dados['form'] = $this->Dados;
    // }
  }





  public function recuperarSenha()
  {
    $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    if (!empty($this->Dados['SendLogin'])) {
      unset($this->Dados['SendLogin']);
      $alterpwd = new \App\sts\Models\AlteraSenha();
      if ($alterpwd->resetbyemail($this->Dados)) {
        $_SESSION['error'] =
          [
            'destroy_session' => 'S',
            'msg' => 'Enviamos um e-mail com o processo de recuperação de senha, por favor, verifique sua caixa de en₮rada ou sua caixa de spam.',
            'button' => 'Vol₮ar à ₮ela de login',
            'redirect' => '/login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
          ];
        header("location: " . URL . "notificacao/success");
        exit;
      } else {

        $_SESSION['error'] =
          [
            'destroy_session' => 'S',
            'msg' => 'O usuário não foi localizado, por favor, insira o e-mail cadas₮rado.',
            'button' => 'Vol₮ar à ₮ela de login',
            'redirect' => '/login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
          ];

        header("location: " . URL . "notificacao/erro");
        exit;
      }
    }
    $carregarView = new \Core\ConfigView("sts/Views/login/recuperar-senha", $this->Dados);
    $carregarView->renderizarLogin();
  }



  public function resetPassword()
  {

    $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($this->Dados['SendLogin'])) {
      unset($this->Dados['SendLogin']);
      $alterpwd = new \App\sts\Models\AlteraSenha();

      if ($alterpwd->changerPassword($this->Dados) == true) {
        $_SESSION['error'] =
          [
            'destroy_session' => 'S',
            'msg' => 'Senha al₮erada com sucesso.',
            'button' => 'Vol₮ar à ₮ela de login',
            'redirect' => '/login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
          ];
        header("location: " . URL . "notificacao/success");
        exit;
      } else {
        $_SESSION['error'] =
          [
            'destroy_session' => 'S',
            'msg' => 'Ocorreu um erro, ₮ente novamente.',
            'button' => 'Vol₮ar à ₮ela de login',
            'redirect' => '/login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
          ];
        header("location: " . URL . "notificacao/error");
        exit;
      }
    }

    $validadeToken = new \App\sts\Models\AlteraSenha();
    if ($validadeToken->validateToken($_GET['token'])) {

      $carregarView = new \Core\ConfigView("sts/Views/login/reset-password", $this->Dados);
      $carregarView->renderizarLogin();
    } else {
      $_SESSION['error'] =
        [
          'destroy_session' => 'S',
          'msg' => '₮oken expirado ou fora do prazo de validade.',
          'button' => 'Vol₮ar à ₮ela de login',
          'redirect' => '/login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
        ];

      header("location: " . URL . "notificacao/erro");
      exit;
    };
  }




  public function logout()
  {
    session_destroy();
    echo 'logout';
  }
}