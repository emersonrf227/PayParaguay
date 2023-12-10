<?php

namespace App\sts\Models\helper;

class StsApiSmartpay
{
	protected $API_USER;
	protected $API_SECRET;
	protected $API_ENDPOINT;
	protected $DEBUG;

	// $API_USER='';   // API USER
	// $API_SECRET=''; // API SECRET
	// $API_URL="https://connect.smartpay.com.vc/api"; // API URL
	// $ApiData= $Api->SendApi("swapix/pixlinkverify", $postData);
	/* ----------------------------------------------------------
 public functions which you can use, here we comment for you
----------------------------------------------------------*/

	/* contructor - creates object
		Expecting 
			string: api-user - api user from wallet
			string: api-secret - api secret from wallet
			string: api-url - full URI to coinBR endpoint
		Returns
		Default
			false. Data is needed
	*/
	public function __construct($user = false, $secret = false, $api = false)
	{
      
		$this->API_USER = $user;
		$this->API_SECRET = $secret;
		$this->API_ENDPOINT = $api;
		$this->DEBUG = false;
	}

	/* setDebug - sets debug output on or off
		Expecting
			bool: state - debug true(enabled), false(disabled)
		Returns
		Default
			state = true
	*/
	public function setDebug($state = true)
	{
		$this->DEBUG = $state;
	}

	/*
		sendApi - send data to the api
		 Expecting
			string: endpoint - endpoint to add on the api URI
			object: data	 - object with data to submit
		Returns
			object: -> string: status = api reply || 'failed'
					-> string: msg = api message, error desciption on fail
					-> object: data = on ok, data if any
	*/
	public function sendApi($apicall, $data)
	{
	    
	    
	    

		$data['api_ts'] = time();
		$data['api_user'] = $this->API_USER;
		$signed_data = $this->signData($data);
		$data['api_sig'] = $signed_data;

		$url = $this->API_ENDPOINT . '/' . $apicall;
		if ($this->DEBUG) {
			print "Sending POST request to: $url \n";
			print "Data to send:\n";
			print_r($data);
		}
		$result = $this->post($url, $data);
		if ($result['content'] === false) {
			$api_reply = [
				'status' => 'failed',
				'msg' => $result['details']
			];
		} else {
			$api_reply = json_decode($result['content'], true);
		}
		return $api_reply;
	}

	/* -----------------------------------------
Private Functions, not usable from outside
------------------------------------------*/

	private function post($url, $data)
	{
		$header = "Content-type: application/x-www-form-urlencoded\r\n"
			. "User-Agent: SPAY_API\r\n";
		$options = [
			'http' => [
				'header'  => $header,
				'method'  => 'POST',
				'timeout' => 10,
				'content' => http_build_query($data),
				'ignore_errors' => true

			]
		];
		$context  = stream_context_create($options);
		$details = '';
		try {
			$result = @file_get_contents($url, false, $context);
			if ($this->DEBUG) {
				print "--> API reply:\n";
				print_r($result);
			}
			if ($result === false) {
				$details = error_get_last();
				$details = $details['message'];
			} else {
				preg_match('/([0-9])\d+/', $http_response_header[0], $matches);
				$rspcode = intval($matches[0]);
				if ($rspcode != 200) {
					$result = false;
					$details = "HTTP Reponse status code: " . $rspcode;
				}
			}
		} catch (Exception $e) {
			$result = false;
			$details = $e->getMessage();
		}
		return ['content' => $result, 'details' => $details];
	}

	private function signData($post_data)
	{
		ksort($post_data);
		$str_post = '';
		foreach ($post_data as $k => $v)
			$str_post .= "$k=$v&";
		$str_post = substr($str_post, 0, -1);
		if ($this->DEBUG) {
			print "hashing: $str_post\n";
		}
		return hash_hmac('sha256', $str_post, $this->API_SECRET);
	}
}
