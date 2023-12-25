<?php

namespace App\sts\Models;

use chillerlan\QRCode\QRCode;
use Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class MovimentModels
{

    private $Dados;
    public function __construct()
    {
    }


    public function checkPayments()
    {

        $node = new \App\sts\Models\NodeModels();
        $pageModels = new \App\sts\Models\PageModels();
        $update = new \App\sts\Models\helper\StsUpdate();

        $f = new \App\sts\Models\helper\StsFormat();
        $uuid_deposit = $f->gen_uuid();

        $orderId = new \App\sts\Models\helper\StsRead();
        $orderId->fullRead("SELECT a.id as orderId, b.id as userId, c.id as walletId, a.*, b.*, c.* FROM `ordem` as a 
        inner join users as b on a.userId = b.id  
        inner join wallets as c on b.id = c.userId  
        WHERE `status` = 'open'");


        if ($orderId->getResultado()) {

            foreach ($orderId->getResultado() as $index) {
                extract($index);
                $create = new \App\sts\Models\helper\StsCreate();
                $update = new \App\sts\Models\helper\StsUpdate();

                $dataEmv = $pageModels->statusEmvInternal($operation_id);
                if ($dataEmv->status === 'failed') {

                    if ($confirm_payments > 20) {
                        $update->exeUpdate("ordem", array("status" => 'cancel'), "WHERE id=$orderId");
                    } else {
                        $newConfirm = $confirm_payments + 1;
                        $update->exeUpdate("ordem", array("confirm_payments" => $newConfirm), "WHERE id=$orderId");
                    }
                } else {
                    $balance = $node->getBalance('polygon', $wallet);
                    $maticBalance = 0.0;
                    if ($balance->statusCode === 200) {
                        $maticBalance = $balance->res->amount;
                    }

                    if ($maticBalance < 0.2) {


                        $parameters = new \App\sts\Models\helper\StsRead();
                        $parameters->fullRead("SELECT * FROM `parameters` limit 1");
                        $hotWallet = HOT_WALLET;
                        $node = new \App\sts\Models\NodeModels();
                        $sendGas =  $node->sendTransfer($hotWallet,  $wallet, 0.12, 'polygon', 'polygon', $uuid_deposit . '-0', 'Send Gastation SG');
                        if ($sendGas->status === 0) {
                            $data['deposit'] = array(
                                "uuid" => $uuid_deposit,
                                "walletId" => $walletId,
                                "orderId" => $orderId,
                                "transactionId" => $sendGas->transactionId,
                                "address" => $wallet,
                                "actual_matic_balance" => $maticBalance,
                                "amount" => $dataEmv->data->rate->send_usd,
                                "currency" => 'pxusdt',
                                "txid_receiver" => $dataEmv->data->txid,
                                "status" => 'new',
                                "date_receiver" => date('Y-m-d'),
                                "matic_amount_send" => 0.12,
                                "refund_count" => 0

                            );
                            $create->exeCreate("deposit", $data['deposit']);
                            $update->exeUpdate("ordem", array("status" => 'done', 'txid' => $dataEmv->data->txid), "WHERE id= $orderId");
                        };
                    } else {
                        $data['deposit'] = array(
                            "uuid" => $uuid_deposit,
                            "walletId" => $walletId,
                            "orderId" => $orderId,
                            "address" => $wallet,
                            "actual_matic_balance" => $maticBalance,
                            "amount" => $dataEmv->data->rate->send_usd,
                            "currency" => "pxusdt",
                            "status" => 'awaiting',
                            "txid_receiver" => $dataEmv->data->txid,
                            "date_receiver" => date('Y-m-d H:i:s'),
                            "matic_amount_send" => 0.0,
                            "refund_count" => 0

                        );
                        $create->exeCreate("deposit", $data['deposit']);
                        $update->exeUpdate("ordem", array("status" => 'done'), "WHERE id= $orderId");
                    }
                }
            }
        }
    }

    public function createDeposit($data)
    {
        $node = new \App\sts\Models\NodeModels();
        $f = new \App\sts\Models\helper\StsFormat();
        $uuid_deposit = $f->gen_uuid();

        $orderId = new \App\sts\Models\helper\StsRead();
        $orderId->fullRead("SELECT a.id as orderId, b.id as userId, c.id as walletId, a.*, b.*, c.* FROM `ordem` as a 
        inner join users as b on a.userId = b.id  
        inner join wallets as c on b.id = c.userId  
        WHERE `uuid` = '{$data['message']}' limit 1");
        if ($orderId->getResultado()) {

            extract($orderId->getResultado()[0]);
            $balance = $node->getBalance('polygon', $wallet);
            $maticBalance = 0.0;
            if ($balance->statusCode === 200) {
                $maticBalance = $balance->res->amount;
            }
            if ($maticBalance < 0.2) {
                $create = new \App\sts\Models\helper\StsCreate();
                $update = new \App\sts\Models\helper\StsUpdate();

                $parameters = new \App\sts\Models\helper\StsRead();
                $parameters->fullRead("SELECT * FROM `parameters` limit 1");
                $hotWallet = HOT_WALLET;
                $toWallet = $wallet;
                $node = new \App\sts\Models\NodeModels();
                $sendGas =  $node->sendTransfer($hotWallet,  $toWallet, 0.12, 'polygon', 'polygon', $uuid_deposit . '-0', 'Send Gastation SG');
                if ($sendGas->status === 0) {
                    $data['deposit'] = array(
                        "uuid" => $uuid_deposit,
                        "walletId" => $walletId,
                        "orderId" => $orderId,
                        "transactionId" => $sendGas->transactionId,
                        "address" => $toWallet,
                        "actual_matic_balance" => $maticBalance,
                        "amount" => $data['amount'],
                        "currency" => $data['currency'],
                        "txid_receiver" => $data["txid"],
                        "status" => 'new',
                        "date_receiver" => date('Y-m-d'),
                        "matic_amount_send" => 0.12
                    );
                    $create->exeCreate("deposit", $data['deposit']);
                    $update->exeUpdate("ordem", array("status" => 'done'), "WHERE id= $orderId");
                };
            } else {
                $data['deposit'] = array(
                    "uuid" => $uuid_deposit,
                    "walletId" => $walletId,
                    "orderId" => $orderId,
                    "address" => $toWallet,
                    "actual_matic_balance" => $maticBalance,
                    "amount" => $data['amount'],
                    "currency" => $data['currency'],
                    "txid_receiver" => $data["txid"],
                    "status" => 'awaiting',
                    "date_receiver" => date('Y-m-d'),
                    "matic_amount_send" => 0.0
                );
                $create->exeCreate("deposit", $data['deposit']);
                $update->exeUpdate("ordem", array("status" => 'done'), "WHERE id= $orderId");
            }
        };
    }



    public function createForward()
    {
        $node = new \App\sts\Models\NodeModels();
        $f = new \App\sts\Models\helper\StsFormat();
        $orderId = new \App\sts\Models\helper\StsRead();
        $orderId->fullRead("SELECT * FROM `deposit` where status = 'awaiting'");
        if ($orderId->getResultado()) {


            foreach ($orderId->getResultado() as $index) {
                extract($index);


                if ($transactionId) {
                    $viewTransaction = $node->viewTransaction($transactionId);



                    if ($viewTransaction->status === 'FAILED') {
                        $update = new \App\sts\Models\helper\StsUpdate();
                        $update->exeUpdate("deposit", array("status" => 'new'), "where id = '$id'");
                        continue;
                    }

                    if ($viewTransaction->status === 'PROCESSING') {
                        continue;
                    }

                    if ($viewTransaction->status === 'SUCCESS') {
                        $uuid_forward = $f->gen_uuid();
                        $update = new \App\sts\Models\helper\StsUpdate();
                        $create = new \App\sts\Models\helper\StsCreate();
                        $update->exeUpdate("deposit", array("status" => 'done'), "where id = '$id'");
                        $forwardWallet = FORWARD_WALLET;
                        $data['forward'] = array(
                            "uuid" => $uuid_forward,
                            "depositId" => $id,
                            "address" => $forwardWallet,
                            "amount" => $amount,
                            "currency" => $currency,
                            "status" => 'new',
                            "data_send" => date('Y-m-d'),
                        );
                        $create->exeCreate("forward", $data['forward']);
                        continue;
                    }
                } else {
                    $uuid_forward = $f->gen_uuid();
                    $update = new \App\sts\Models\helper\StsUpdate();
                    $create = new \App\sts\Models\helper\StsCreate();
                    $update->exeUpdate("deposit", array("status" => 'done'), "where id = '$id'");
                    $forwardWallet = FORWARD_WALLET;
                    $data['forward'] = array(
                        "uuid" => $uuid_forward,
                        "depositId" => $id,
                        "address" => $forwardWallet,
                        "amount" => $amount,
                        "currency" => $currency,
                        "status" => 'new',
                        "data_send" => date('Y-m-d'),
                    );
                    $create->exeCreate("forward", $data['forward']);
                    continue;
                }
            }
        }
    }

    public function sendForward()
    {

        $node = new \App\sts\Models\NodeModels();
        $f = new \App\sts\Models\helper\StsFormat();
        $uuid_deposit = $f->gen_uuid();
        $fowardId = new \App\sts\Models\helper\StsRead();
        $fowardId->fullRead("SELECT  a.id, a.amount, a.currency, a.refund_count, a.address, a.uuid, c.wallet FROM `forward` as a inner join deposit as b on a.depositId = b.id inner join wallets as c on b.walletId = c.id where a.status = 'new'");
        if ($fowardId->getResultado()) {
            foreach ($fowardId->getResultado() as $index) {
                extract($index);
                $balance = $node->getBalance('polygon', $wallet);
                var_dump($balance);
                if ($balance->statusCode === 200) {
                    $maticBalance = $balance->res->amount;
                }
                if ($maticBalance > 0.1) {
                    $refund_count =  $refund_count + 1;
                    $node = new \App\sts\Models\NodeModels();
                    $sendGas =  $node->sendTransfer($wallet,  $address, $amount, 'polygon', 'usdt', "forward-" . $uuid_deposit . '-' . $refund_count, 'Forward Token');

                    if ($sendGas->status === 0) {
                        $update = new \App\sts\Models\helper\StsUpdate();
                        $data['forward'] = array(
                            "transactionId" => $sendGas->transactionId,
                            "status" => 'awaiting',
                            "refund_count" => $refund_count
                        );
                        $update->exeUpdate("forward", $data['forward'], "WHERE id= $id");
                        continue;
                    } else {
                        continue;
                    }
                }
            }
        }
    }



    public function confirmForward()
    {

        $node = new \App\sts\Models\NodeModels();
        $f = new \App\sts\Models\helper\StsFormat();
        $fowardId = new \App\sts\Models\helper\StsRead();
        $fowardId->fullRead("SELECT * FROM `forward` where status = 'awaiting'");
        if ($fowardId->getResultado()) {

            foreach ($fowardId->getResultado() as $index) {
                extract($index);
                $viewTransaction = $node->viewTransaction($transactionId);
                var_dump($viewTransaction);

                if ($viewTransaction->status === 'FAILED') {
                    $update = new \App\sts\Models\helper\StsUpdate();
                    $update->exeUpdate("forward", array("status" => 'new'), "where id = '$id'");
                    continue;
                }

                if ($viewTransaction->status === 'PROCESSING') {
                    continue;
                }

                if ($viewTransaction->status === 'SUCCESS') {
                    $update = new \App\sts\Models\helper\StsUpdate();
                    $update->exeUpdate("forward", array("status" => 'done',  "txid" => $viewTransaction->txHash), "where id = '$id'");
                }
            }
        }
    }


    public function sendGasNew()
    {

        $node = new \App\sts\Models\NodeModels();
        $f = new \App\sts\Models\helper\StsFormat();
        $uuid_deposit = $f->gen_uuid();

        $orderId = new \App\sts\Models\helper\StsRead();
        $orderId->fullRead("SELECT * FROM `deposit` where status = 'new'");
        if ($orderId->getResultado()) {

            foreach ($orderId->getResultado() as $index) {
                extract($index);

                $balance = $node->getBalance('polygon', $address);
                $maticBalance = 0.0;
                if ($balance->statusCode === 200) {
                    $maticBalance = $balance->res->amount;
                }

                if ($maticBalance < 0.12) {
                    $refund_count =  $refund_count + 1;
                    $hotWallet = HOT_WALLET;
                    $toWallet = $address;
                    $node = new \App\sts\Models\NodeModels();
                    $sendGas =  $node->sendTransfer($hotWallet,  $toWallet, 0.12, 'polygon', 'polygon', $uuid_deposit . '-' . $refund_count, 'Send Gastation SG');
                    if ($sendGas->status === 0) {
                        $update = new \App\sts\Models\helper\StsUpdate();
                        $data['order'] = array(
                            "transactionId" => $sendGas->transactionId,
                            "actual_matic_balance" => $maticBalance,
                            "status" => 'awaiting',
                            "date_receiver" => date('Y-m-d'),
                            "refund_count" => $refund_count
                        );
                        $update->exeUpdate("deposit", $data['order'], "WHERE id= $id");
                        continue;
                    } else {

                        continue;
                    }
                } else {
                    $uuid_forward = $f->gen_uuid();
                    $update = new \App\sts\Models\helper\StsUpdate();
                    $create = new \App\sts\Models\helper\StsCreate();
                    $update->exeUpdate("deposit", array("status" => 'done'), "where id = '$id'");
                    $forwardWallet = FORWARD_WALLET;
                    $data['forward'] = array(
                        "uuid" => $uuid_forward,
                        "depositId" => $id,
                        "address" => $forwardWallet,
                        "amount" => $amount,
                        "currency" => $currency,
                        "status" => 'new',
                        "data_send" => date('Y-m-d'),
                    );
                    $create->exeCreate("forward", $data['forward']);
                }
            }
        }
    }
}
