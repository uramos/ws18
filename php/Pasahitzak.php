<?php

	require_once('../nusoap-0.9.5/lib/nusoap.php');
	require_once('../nusoap-0.9.5/lib/class.wsdlcache.php');
	

//$ns="http://localhost:80/ws18nirea/php/Pasahitzak.php?wsdl";
$ns="https://wsuramos.000webhostapp.com/WS21_Lab7/lab7-1/ws18nirea/php/Pasahitzak.php?wsdl";

$server = new soap_server;
$server->configureWSDL('pasahitzaDa',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
$server->register('pasahitzaDa', array('x'=>'xsd:string', 'y'=>'xsd:int'),array('z'=>'xsd:string'), $ns);

function pasahitzaDa($x, $y){
	if($y != 1010){
		return "Zerbitzurik gabe.";
	}else{		
		$pasahitzak = fopen("toppasswords.txt","r");
		while ($pass = fscanf($pasahitzak, "%s")){
			if ($x == $pass[0]) return "Ez-Onartua";
		}	
			fclose($pasahitzak);
			return "Onartua";		
	}
}

if (!isset( $HTTP_RAW_POST_DATA )) {
	$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);
?>