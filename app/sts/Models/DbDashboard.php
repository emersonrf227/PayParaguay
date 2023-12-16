<?php

namespace App\sts\Models;

class DbDashboard
{




    function getDataDashboard()
    {

        $users = new \App\sts\Models\helper\StsRead();
        $totalOrders = new \App\sts\Models\helper\StsRead();
        $transaction = new \App\sts\Models\helper\StsRead();
        $balance = new \App\sts\Models\helper\StsRead();

        $datai = date('Y-m-01 00:00:00');
        $dataf = date('Y-m-t 23:59:39');

        $users->fullRead("SELECT * FROM `users` where active = 1");

        $totalOrders->fullRead("SELECT sum(amount) as amount FROM `invoice` where status = 'COMPLETED' and createdAt  between '$datai' and   '$dataf'");
        $transaction->fullRead("SELECT * FROM `invoice` where status = 'COMPLETED'   order by id desc  limit 10 ");
        $balance->fullRead("SELECT * FROM `transactions` order by id desc  limit 1");



        $display = array(
            'error' => 0,
            'msg' => 'Uploaded Successfully!',
            'res' => array(
                "total_users" =>  $users->getResultado(),
                "total_sum_orders" => $totalOrders->getResultado()[0] !== null ? $totalOrders->getResultado()[0] : 0.00,
                "transactions" =>  $transaction->getResultado(),
                "balance" => $totalOrders->getResultado()[0] !== null ? $totalOrders->getResultado()[0] : 0.00,
            )
        );
        echo json_encode($display, true);
    }
}
