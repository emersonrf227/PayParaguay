<?php

namespace App\sts\Controllers;



class Api
{

	private $Dados;


	public function priceTty()
	{

        $curl = new \App\sts\Models\helper\StsCurl();

		$retornoTheter = $curl->sendApiNoParam("https://connect.smartpay.com.vc/api/swapix/swapquote?currency=brl&type=sell&profile=payment&target=all&conv=txusdt&amount=1", NULL, NULL, 'GET');
		$retornoTty = $curl->sendApiNoParam("https://app.geckoterminal.com/api/p1/bsc/pools/0xff3eb0d515310097e1959ec6eee578ee7bd320ad?include=dex%2Cdex.network.explorers%2Cnetwork_link_services%2Ctoken_link_services%2Cdex_link_services&base_token=0", NULL, NULL, 'GET');
		$data = array(
			"error" => 0,
			"cotacao_ustd" => $retornoTheter->data->price_usd,
			"cotacao_tty" => number_format($retornoTty->data->attributes->price_in_usd, 9, '.', '')
		);
		
		echo json_encode($data, true);
	}


	public function validatePassForm()
	{
		$consultaUsuario = new StsRead();
		$dataUser = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$user = addslashes($dataUser['user']);
		$pass = addslashes($dataUser['secret']);
		$consultaUsuario->fullRead("SELECT sts_auth_secret from sts_auth_api where sts_auth_user=  '$user' ");
		$dados = $consultaUsuario->getResultado();
		if ($dados[0]["sts_auth_secret"]) {
			if (password_verify($pass, $dados[0]["sts_auth_secret"])) {
				$this->smartCheckout();
			} else {
				http_response_code(501);

				$display = array(
					"error" => 2089,
					"msg" => "invalid authentication"
				);
				echo json_encode($display, true);
				exit;
			}
		} else {
			http_response_code(501);
			$display = array(
				"error" => 2090,
				"msg" => "invalid authentication"
			);
			echo json_encode($display, true);
			exit;
		};
	}




	//smartpayapi
	//PzVIDVfbaeWxMlH6hT650nTojkC

	public function smartCheckout()
	{		
		$ps = new \App\sts\Models\helper\StsLogv2();
		$ps->openArquivoLog('SmartPay', json_encode($this->Dados), 'json', 'logSmartpay'.'/');
	
	}
}
