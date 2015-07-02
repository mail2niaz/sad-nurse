 <?php
 
      error_reporting(-1);
      ini_set('log_errors','0'); 
      ini_set('display_errors','1'); 
	  ini_set('allow_url_fopen','On'); 
      error_reporting(2047);	
	require_once "nusoap.php";
	ini_set('soap.wsdl_cache_enabled',0);
	ini_set('soap.wsdl_cache_ttl',0);
	$client = new SoapClient("http://93.63.250.130:8080/TPD2009/tpd2009?wsdl");
	$client->__setLocation("http://93.63.250.130:8080/TPD2009/tpd2009?wsdl");

	$username = 'tpd';
	$password = 'ComuneTpd01';
    //$evento = array();//'sendEvento';
	
       $evento =  array(
		"idEventoTrasmesso" => '111',
		"codiceContratto" => '8888',
		"codiceSottoContratto" => '1',
		"codicePresidio" => '',
		"CFOperatore" => 'FNTVNI73R17C950I',
		"descOperatore" => 'test operatore',
		"tipoEvento" => 'A',
		"codiceUtente" => 'FNTVNI73R17C950I',
		"idAccesso" => '100',
		"dataTimeInizioEvento" => '10/12/2014 10:10:00',
		"durataEvento" => '90',
		"dataTimeInizioPrestazione" => '10/12/2014 10:10:00',
		"durataPrestazione" => '90',
		"codicePrestazione" => '201'
	); 
	
      $result = $client->sendEvento(array(
		"user" => $username,
		"password" => $password,
		"evento" => $evento
	));

	



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
