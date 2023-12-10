<?php

namespace App\sts\Models;

class DbDashboard
{




    function getDataDashboard()
    {

        $users = new \App\sts\Models\helper\StsRead();
        $totalOrders = new \App\sts\Models\helper\StsRead();
        $transaction = new \App\sts\Models\helper\StsRead();
        $node = new \App\sts\Models\NodeModels();
        $hot = HOT_WALLET;

        $getBalance = $node->getBalance('polygon', $hot);

        if ($getBalance->statusCode == '200') {

            $balance = $getBalance->res->amount;
        } else {
            $balance = 'Balance Unavailable.';
        }

        $datai = date('Y-m-01 00:00:00');
        $dataf = date('Y-m-t 23:59:39');

        $users->fullRead("SELECT * FROM `users` where active = 1");

        $totalOrders->fullRead("SELECT sum(amount_brl) as amount_brl FROM `ordem` where status = 'done' and created  between '$datai' and   '$dataf'  and  active = 1");
        $transaction->fullRead("SELECT * FROM `ordem` where status = 'done'   order by id desc  limit 10 ");

        $display = array(
            'error' => 0,
            'msg' => 'Uploaded Successfully!',
            'res' => array(
            "total_users" =>  $users->getResultado(),
            "total_sum_orders" =>  $totalOrders->getResultado()[0],
            "transactions" =>  $transaction->getResultado(),
            "hot_balance" => $balance
        ));
        echo json_encode($display, true);
    }
}
