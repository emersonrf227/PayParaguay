<?php

namespace App\sts\Models\helper;

class StsGetLogged
{
	protected $URL;
	protected $KEY;

	public function __construct()
	{
		$this->URL = 'https://api.openpix.com.br/api/v1/';
		$this->KEY = 'Q2xpZW50X0lkX2RjYjVkZjVmLWI0NGYtNDNjMy05OWEyLTNkOTBjMWZjNDcyZjpDbGllbnRfU2VjcmV0X05mU1lwR09hYXZSdnVSZHNrY01nMG9Qblc5MER1VWt0dDhhV0hKdDlpeVE9';
	}




	public function getLogged($uuid)
	{

		$getUser = new \App\sts\Models\helper\StsRead();
		$getUser->fullRead("SELECT a.id as authId, b.id as accountId, c.id as userId, a.*, b.*, c.*   from authentication as a 
		inner join account as b on a.id = b.authenticationId 
		inner join users as c on a.id = c.authenticationId where a.uuid ='$uuid';
		");


		return $getUser->getResultado()[0];
	}
}
