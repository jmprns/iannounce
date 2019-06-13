<?php

function envUpdate($key, $value)
{
    $path = base_path('.env');

    if (file_exists($path)) {

        file_put_contents($path, str_replace(
            $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
        ));
    }
}

function isAlive($host, $port)
{
	$checkSMSGateway = @fsockopen($host, $port, $errorno, $errstr, 10 );
  	return (!$checkSMSGateway) ? FALSE : TRUE;
}

function send_sms($number, $message)
{
	$mode = env('SMS_MODE');

	if($mode == 'OZEKI'){
		$handler = send_ozeki($number, $message);
	}else{
		$handler = send_rest($number, $message);
	}


	return $handler;


}

function send_ozeki($number, $message)
{

	$host = env('SMS_HOST');
	$username = env('SMS_USER');
	$password = env('SMS_PASS');

	$new_message = $message."\n This is system generated text message of WUP-AURORA. Do not reply.";

	$message_encode = urlencode($new_message);

	$curl = curl_init();
	$url = "http://{$host}/api?action=sendmessage&username={$username}&password={$password}&recipient={$number}&messagetype=SMS:TEXT&messagedata={$message_encode}";

	curl_setopt_array($curl, array(
	   CURLOPT_RETURNTRANSFER => 1,
	   CURLOPT_URL => $url ,
	   CURLOPT_SSL_VERIFYPEER => false, // If You have https://
	   CURLOPT_SSL_VERIFYHOST => false,
	   CURLOPT_CUSTOMREQUEST => "GET",
	   CURLOPT_HTTPHEADER => array(
	    		// Set here requred headers
	        	"content-type: application/xml",
	    	),
	));

	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	$handler = array();

	if( !$resp ){

   	// log this Curl ERROR:

		$handler['status'] = 'error';
		$handler['code'] = 404;
		$handler['message'] = 'Cannot connect to the host';
   
	}else{

	$xml = simplexml_load_string($resp);
	$json = json_encode($xml);
	$finalr = json_decode($json);

		if($finalr->action == 'error'){

			$handler['status'] = 'error';
			$handler['code'] = $finalr->data->errorcode;
			$handler['message'] = $finalr->data->errormessage;

		}else{
			$handler['status'] = 'success';
			$handler['code'] = 200;
			$handler['message'] = 'Message accepted for delivery.';
			$handler['sms_id'] = $finalr->data->acceptreport->messageid;
		}

	}

	curl_close($curl);

	return $handler;

}


function send_rest($number, $message)
{
	$host = env('SMS_REST');

	$new_message = $message."\n This is system generated text message of WUP-AURORA. Do not reply.";

	$message_encode = urlencode($new_message);

	$curl = curl_init();
	$url = "http://{$host}?number={$number}&text={$message_encode}";

	curl_setopt_array($curl, array(
	   CURLOPT_RETURNTRANSFER => 1,
	   CURLOPT_URL => $url ,
	   CURLOPT_SSL_VERIFYPEER => false, // If You have https://
	   CURLOPT_SSL_VERIFYHOST => false,
	   CURLOPT_CUSTOMREQUEST => "GET",
	   CURLOPT_HTTPHEADER => array(
	    		// Set here requred headers
	        	"content-type: application/xml",
	    	),
	));

	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	$handler = array();

	if( !$resp ){

   	// log this Curl ERROR:

		$handler['status'] = 'error';
		$handler['code'] = 404;
		$handler['message'] = 'Cannot connect to the host';
   
	}else{
		$handler['status'] = 'success';
		$handler['code'] = 200;
		$handler['message'] = 'Message accepted for delivery.';
	}

	curl_close($curl);

	return $handler;
}


function announcement_status_helper($val)
{
	if($val == '1'){
		return '<span class="label label-warning">Published. Waiting for approval.</span>';
	}else{
		return '<span class="label label-success">Approved. Added in SMS server.</span>';
	}
}

function announcement_status_helper2($val)
{
	if($val == '1'){
		return '<span class="label label-warning">Pending</span>';
	}else{
		return '<span class="label label-success">Approved</span>';
	}
}

function audience_helper($x, $y)
{
	if($x == 'true' && $y == 'true'){
		return $z = 1;
	}elseif($x == 'true' && $y == 'false'){
		return $z = 2;
	}elseif($x == 'false' && $y == 'true'){
		return $z = 3;
	}else{
		return $z = 0;
	}
}

function audience_decode_helper($val)
{
	if($val == 1){
		return 'Student & Guardian';
	}elseif($val == 2){
		return 'Student';
	}elseif($val == 3){
		return 'Guardian';
	}else{
		return 'Undefined';
	}
}