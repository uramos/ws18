<?php
	require_once('../nusoap-0.9.5/lib/nusoap.php');
	require_once('../nusoap-0.9.5/lib/class.wsdlcache.php');
	
	
	$password = $_POST['password'];
	//$soapclient = new nusoap_client('http://localhost/WS21_Lab6/ws18nirea/php/Pasahitzak.php?wsdl',true); 
	$soapclient = new nusoap_client('https://wsuramos.000webhostapp.com/WS21_Lab7/lab7-1/ws18nirea/php/Pasahitzak.php?wsdl',true);
	
	$emaitza = $soapclient->call('pasahitzaDa',array ('x'=>$password, 'y'=>1010));

	echo "$emaitza";	
?>