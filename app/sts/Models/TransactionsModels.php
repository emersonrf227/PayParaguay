<?php

namespace App\sts\Models;

// ZpKYm3,C#]0K
class TransactionsModels
{
    private $Dados;


    public function listTransaction($page, $query)
    {


        $limit = 10;
        $offset = ($page - 1) * $limit;
        $ordem = new \App\sts\Models\helper\StsRead();
        $pagination = new \App\sts\Models\helper\StsRead();
        $ordem->fullRead("SELECT SQL_CALC_FOUND_ROWS  addressWallet, a.id, txid, total_brl, fee_brl, amount_brl, b.document, a.name, a.status, a.updateAt, a.hash, a.created  FROM ordem as a inner join users as b on a.userId = b.id WHERE a.active = 1 $query LIMIT  $offset, $limit ");
        $pagination->fullRead("SELECT  found_rows() as total_row");
        $total_row =  $pagination->getResultado()[0]['total_row'];
        $total_pagination =  ceil($total_row / $limit);

        echo json_encode(array(
            "error" => 0,
            "msg" => 'Update List',
            "res" => $ordem->getResultado(),
            "pagination" => array("total_row" => $total_row, "actual_page" => $page, "total_pagination" => $total_pagination)
        ), true);
    }

    public function getReceipt($uuid)
    {



        $ordem = new \App\sts\Models\helper\StsRead();
        $pagination = new \App\sts\Models\helper\StsRead();
        $ordem->fullRead("SELECT c.name, c.email, c.phone, b.status as status_order, txid_receiver, operation_id,  amount_brl, price_usd, total_brl, fee_brl , send_usd, f.txid, f.amount, f.status as status_forward, f.address as wallet_destination, b.address as wallet_origin, a.created, f.createdAt   FROM ordem as a 
        INNER JOIN deposit as b on a.id = b.orderId 
        INNER JOIN users as c on a.userId = c.id 
        INNER JOIN forward as f on b.id = f.depositId 
        WHERE a.hash ='$uuid'");

        if ($ordem->getResultado()) {
            extract($ordem->getResultado()[0]);


            echo json_encode(array(
                "error" => 0,
                "msg" => 'Update List',
                "res" =>  array(
                    "order" => array(
                        "name" => $name,
                        "email" => $email,
                        "phone" => $phone,
                        "status" => $status_order,
                        "txid_receiver" => $txid_receiver,
                        "operation_id" => $operation_id,
                        "amount_brl" => $amount_brl,
                        "price_usd" => $price_usd,
                        "total_brl" => $total_brl,
                        "fee_brl" => $fee_brl,
                        "send_usd" => $send_usd,
                        "created" => $created,
                    ),
                    "forward" => array(
                        "txid" => $txid,
                        "amount" => $amount,
                        "status" => $status_forward,
                        "origin_wallet" => $wallet_origin,
                        "destination_wallet" => $wallet_destination,
                        "created" => $createdAt,
                    )

                )
            ), true);
        }
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
