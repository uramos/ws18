<?php

	require_once('../nusoap-0.9.5/lib/nusoap.php');
	require_once('../nusoap-0.9.5/lib/class.wsdlcache.php');
	

//$ns="http://localhost:80/WS21_Lab6/ws18nirea/php/Pasahitzak.php?wsdl";
$ns="https://wsuramos.000webhostapp.com/WS21_Lab7/lab7-1/ws18nirea/php/Pasahitzak.php?wsdl";
$server = new soap_server;
$server->configureWSDL('pasahitzaDa',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('pasahitzaDa', array('x'=>'xsd:string', 'y'=>'xsd:int'),array('z'=>'xsd:string'), $ns);

function pasahitzaDa($x, $y){
	if($y != 1010){
		return "Zerbitzurik gabe.";
	}else{		$pasahitzak = file("toppasswords.txt");
			foreach($pasahitzak as $pass){			
			if(strstr($pass,$x)){			
			return "Ez-Onartua";			
			}else{				
			return "Onartua";		
			}		
			}
	}
}

if (!isset( $HTTP_RAW_POST_DATA )) {
	$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);
?>