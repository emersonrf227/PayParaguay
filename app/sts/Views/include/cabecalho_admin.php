<?php
/*
if (!defined('URL')) {
  header("Location: /");
  exit();
}

if ($_SESSION['hash_master'] == NULL) {
  $_SESSION['error'] =
    [
      'destroy_session' => 'S',
      'msg' => 'Para acessar essa página é necessário efetuar o login na plataforma.',
      'button' => 'Voltar à tela de login',
      'redirect' => 'login/acesso' //CONTROLLER/MÉTODO/PARÂMETRO
    ];

  header("location: " . URL . "notificacao/erro");
  exit;
}
*/
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/sg-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/sg-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Admin - Smart Gateway
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<div class="loader"
    style="display: block; position: fixed; top: 0px; left: 0px; z-index: 99999; background-color: rgb(0, 0, 0); width: 100%; height: 100%; opacity: 0.9; justify-content: center;">
    <div
        style=" width: 100%; height:  100%;background: #FFF ;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        <div>
            <img src="<?php echo URL ?>assets/img/LinhasAtivo1.png" style="width:300px;">
            <center>
                <h6 style="color: #00162E;"> Aguarde, carregando!!! </h6>
            </center>
        </div>
    </div>
</div>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">

            <div class="logo">
                <a class="simple-text logo-normal">
                    Smart Gateway
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item <?php if ($active == 'home') {
                                            echo "active";
                                        } ?>  ">
                        <a class="nav-link" href="dashboard">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item  <?php if ($active == 'transaction') {
                                                echo "active";
                                            } ?>  ">
                        <a class="nav-link" href="view-transactions">
                            <i class="material-icons">list</i>
                            <p>Transações</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($active == 'clients') {
                                            echo "active";
                                        } ?> ">
                        <a class="nav-link" href="view-users">
                            <i class="material-icons">search</i>
                            <p>Clientes</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item ">
                        <a class="nav-link" href="./perfil.html">
                            <i class="material-icons">account_circle</i>
                            <p>Perfil do Usuário</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:void(0)"><?php echo $title ?></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="" class="nav-link" onclick="return signout()">
                                    <i class="material-icons" style="color:#ff9800;">logout</i>
                                    <p class="d-lg-none d-md-block">
                                        Account
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>