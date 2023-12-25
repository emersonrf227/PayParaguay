<?php

namespace App\sts\Models\helper;

class StsApiOpenPix
{
	protected $URL;
	protected $KEY;

	public function __construct()
	{
		$this->URL = 'https://api.openpix.com.br/api/v1/';
		$this->KEY = 'Q2xpZW50X0lkX2RjYjVkZjVmLWI0NGYtNDNjMy05OWEyLTNkOTBjMWZjNDcyZjpDbGllbnRfU2VjcmV0X05mU1lwR09hYXZSdnVSZHNrY01nMG9Qblc5MER1VWt0dDhhV0hKdDlpeVE9';
	}




	public function getQrcode($data)
	{
		$call = new \App\sts\Models\helper\StsCurl();
		try {
			$url = $this->URL . 'qrcode-static';
			$header =	array(
				'Content-Type: application/json',
				'Accept: application/json',
				'Authorization:' . $this->KEY
			);
			$response =	$call->sendApi($url, $data, $header, 'POST');
			return $response;
		} catch (Exception $e) {
			return $e;
		}
	}
}
