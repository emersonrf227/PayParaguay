<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Users
{



    private $Dados;
    private $DataToken;


    function __construct()
    {
        $val =  new \App\sts\Models\GetHeader();
        $this->DataToken = $val->validatyToken();
    }

    public function list()
    {
        $page = addslashes($_GET['page']);
        $query = '';

        if (!empty($_GET['statusFil'])) {
            $statusFil = addslashes($_GET['statusFil']);
            if ($statusFil === 'T') {
                $query .= "a.active in (0,1) ";
            } else {
                $query .= "a.active = '$statusFil'";
            }
        } else {
            $query .= "a.active in (0,1) ";
        }


        if (!empty($_GET['name'])) {
            $name = addslashes($_GET['name']);
            $query .= "and name like '%$name%'";
        }


        $transactions  = new \App\sts\Models\UsersModels();
        return $transactions->listUsers($page, $query);
    }
}
