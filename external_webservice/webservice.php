<?php
	 error_reporting(-1);
      ini_set('log_errors','0'); 
      ini_set('display_errors','1'); 
      error_reporting(2047);
	require_once "nusoap.php";
	ini_set('soap.wsdl_cache_enabled',0);
	ini_set('soap.wsdl_cache_ttl',0);
	$client = new SoapClient("http://www.messagenet.com.au/dotnet/Lodge.asmx?WSDL",array('exceptions' => 0));
 	$phone = "61412123456"; //include country code and area code
 	$message = "Test MessageNet";
 	$result = $client->LodgeSMSMessage(array(
		"Username" => "user1",
		"Pwd" => "password",
		"PhoneNumber" => $phone,
		"PhoneMessage" => $message
	));
 	$response_arr = objectToArray($result);
 	echo "<pre>";
 	print_r($response_arr);
 	echo "return_code= " . str_replace(";", "", $response_arr["LodgeSMSMessageResult"]);
 	function objectToArray($d)
	{
		if (is_object($d))
		{
			$d = get_object_vars($d);
		}
 
		if (is_array($d))
		{
			return array_map(__FUNCTION__, $d);
		}
		else
		{
			return $d;
		}
	}
?>
