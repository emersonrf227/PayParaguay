<?php

namespace App\sts\Models;

// ZpKYm3,C#]0K
class ClientsModels
{
    private $Dados;


    public function listClients($page)
    {

        $limit = 2;
        $offset = ($page - 1) * $limit;
        $users = new \App\sts\Models\helper\StsRead();
        $pagination = new \App\sts\Models\helper\StsRead();
        $users->fullRead("SELECT SQL_CALC_FOUND_ROWS * FROM users LIMIT  $offset, $limit ");
        $pagination->fullRead("SELECT  found_rows() as total_row");
        $total_row =  $pagination->getResultado()[0]['total_row'];
        $total_pagination =  ceil($total_row / 2);
        echo json_encode(array(
            "error" => 0,
            "msg" => 'Update List',
            "res" => $users->getResultado(),
            "pagination" => array("total_row" => $total_row, "actual_page" => $page, "total_pagination" => $total_pagination)
        ), true);
    }



    public function updateUsers()
    {
        $f = new \App\sts\Models\helper\StsFormat();

        if ($_POST['forceReset'] == '*') {
            $hashpwd = password_hash(102030, PASSWORD_DEFAULT);

            $data['account'] = array(
                "name" =>  utf8_decode(ucwords(addslashes($_POST['name']))),
                "username" =>  utf8_decode(addslashes($_POST['username'])),
                "active" => addslashes($_POST['active']),
                "forceReset" => addslashes($_POST['forceReset']),
                "password" => $hashpwd,
                "updateAt" => date('Y-m-d H:i:s')
            );
        } else {
            $data['account'] = array(
                "name" =>  utf8_decode(ucwords(addslashes($_POST['name']))),
                "username" =>  utf8_decode(addslashes($_POST['username'])),
                "active" => addslashes($_POST['active']),
                "forceReset" => addslashes($_POST['forceReset']),
                "updateAt" => date('Y-m-d H:i:s')
            );
        }

        $hash = addslashes($_POST['hash']);

        $update = new \App\sts\Models\helper\StsUpdate();
        $update->exeUpdate("account",  $data['account'],  "WHERE hash = '$hash'");
        if ($update->sqlResult()['data']['status'] === 'success') {
            $display = array(
                "error" => 0,
                "msg" => "Atualizado com sucesso"
            );
            echo json_encode($display, true);
            exit;
        } else {

            $display = array(
                "error" => 2932,
                "msg" => "Ocorreu um erro"
            );
            echo json_encode($display, true);
            exit;
        }
    }


    public function viewUsers($hash)
    {
        //nft select 
        $account = new \App\sts\Models\helper\StsRead();
        $account->fullRead("SELECT * FROM `account` where hash = '$hash' ");
        return  $account->getResultado()[0];
    }



    public function putCadUser()
    {
        $f = new \App\sts\Models\helper\StsFormat();
        $username = addslashes($_POST['username']);
        $query = new \App\sts\Models\helper\StsRead();
        $query->fullRead("SELECT * FROM account WHERE username = '$username' ");
        if ($query->getResultado()) {

            $display = array("error" => 1921, "msg" => 'Usuario ja cadastrado.');
            echo json_encode($display, true);
            exit;
        }


        $hashpwd = password_hash(addslashes($_POST['password']), PASSWORD_DEFAULT);
        $uuid = $f->gen_uuid();
        $data['account'] = array(
            "hash" => $uuid,
            "username" =>  utf8_decode(addslashes($_POST['username'])),
            "name" =>  utf8_decode(ucwords(addslashes($_POST['name']))),
            "password" =>  $hashpwd,
            "active" => 1,
            "createdAt" => date('Y-m- H:i:s')
        );
        $create = new \App\sts\Models\helper\StsCreate();
        $create->exeCreate("account", $data['account']);
        $idCreate = $create->getResultado();

        if ($idCreate) {
            $display = array("error" => 0, "msg" => 'Cadastro Realizado');
            echo json_encode($display, true);
            exit;
        } else {
            $display = array("error" => 1922, "msg" => 'Ocorreu um erro');
            echo json_encode($display, true);
            exit;
        }
    }
}
