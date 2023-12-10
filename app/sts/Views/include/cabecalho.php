<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo URL ?>assets/img/favicon.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Smart Gateway
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="<?php echo URL ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo URL ?>assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo URL ?>assets/demo/demo.css" rel="stylesheet" />
</head>

<div class="loader"
    style="display: block; position: fixed; top: 0px; left: 0px; z-index: 99999; background-color: rgb(0, 0, 0); width: 100%; height: 100%; opacity: 0.9; justify-content: center;">
    <div
        style=" width: 100%; height:  100%;background: #FFF ;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        <div>
            <img src="<?php echo URL ?>assets/img/LinhasAtivo1.png" style="width:300px;">
            <br><br>
            <center>
                <h6 style="color: #00162E;"> Aguarde, carregando!!! </h6>
            </center>
        </div>
    </div>
</div>

<body class="index-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" rel="tooltip" data-placement="bottom">
                    <?php if ($this->navBar) {
                        echo "<img src='./assets/img/LinhasAtivo3.png' class='invision-logo' />";
                    } ?>

                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->