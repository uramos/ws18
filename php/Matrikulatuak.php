<?php
	require_once('../nusoap-0.9.5/lib/nusoap.php');
	require_once('../nusoap-0.9.5/lib/class.wsdlcache.php');
	
	
	$posta = $_GET['posta'];
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl',true);
	
	$emaitza = $soapclient->call('egiaztatuE',array ('x'=>$posta));
	
	echo "$emaitza";
			
?>