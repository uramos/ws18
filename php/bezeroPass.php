	<?php
	require_once('../nusoap-0.9.5/lib/nusoap.php');
	require_once('../nusoap-0.9.5/lib/class.wsdlcache.php');
	
	
	$password = $_POST['password'];
	//$soapclient = new nusoap_client('http://localhost/ws18/php/Pasahitzak.php?wsdl',true); 
	$soapclient = new nusoap_client('https://wsuramos.000webhostapp.com/WS21_Lab6/ws18/ph/Pasahitzak.php?wsdl',true); 
	
	$emaitza = $soapclient->call('pasahitza_Da',array ('x'=>$password, 'y'=>"konprobatu"));
	
	echo "$emaitza";
			
?>