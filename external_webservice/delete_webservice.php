 <?php
 
      error_reporting(-1);
      ini_set('log_errors','0'); 
      ini_set('display_errors','1'); 
      error_reporting(2047);	
	require_once "nusoap.php";
	ini_set('soap.wsdl_cache_enabled',0);
	ini_set('soap.wsdl_cache_ttl',0);
	$client = new SoapClient("http://93.63.250.130:8080/TPD2009/tpd2009?wsdl");
	$client->__setLocation("http://93.63.250.130:8080/TPD2009/tpd2009?wsdl");
	$username = 'tpd';
	$password = 'ComuneTpd01';
      $params = array(
            "user" => $username,
            "password" =>$password,
			"idEvento" => "001"
                  );
	echo "<pre>";
	print_r($params); 
      $result = $client->deleteEvento($params);

	print_r($result);die;



   	$response_arr = objectToArray($result);
    echo "return_code= " . str_replace(";", "", $response_arr["sendEventoResponse"]);
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
