<?php

namespace App\sts\Controllers;



class Callback
{

	private $Dados;

	function __construct()
	{
		// ini_set('display_errors',1);
		// ini_set('display_startup_erros',1);
		// error_reporting(E_ALL);

		$this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		//$this->smartCheckout();


		// if ($_SERVER['PHP_AUTH_USER']) {
		// 	$this->validatePassHeader();
		// } else if ($this->Dados['user']) {
		// 	$this->validatePassForm($this->Dados);
		// }
	}


	public function validatePassHeader()
	{
		$consultaUsuario = new StsRead();
		$user = addslashes($_SERVER['PHP_AUTH_USER']);
		$pass = $_SERVER['PHP_AUTH_PW'];
		$consultaUsuario->fullRead("SELECT sts_auth_secret from sts_auth_api where sts_auth_user=  '$user' ");
		$dados = $consultaUsuario->getResultado();
		if ($dados[0]["sts_auth_secret"]) {
			if (password_verify($pass, $dados[0]["sts_auth_secret"])) {
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

		if ($this->Dados['action'] === 'deposit') {
			$movimentModels = new \App\sts\Models\MovimentModels();
			return	$movimentModels->createDeposit($this->Dados);
		}
	}
}
