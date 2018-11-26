<?php
//nusoap.php klasea gehitzen dugu
	require_once('../nusoap-0.9.5/lib/nusoap.php');
	require_once('../nusoap-0.9.5/lib/class.wsdlcache.php');
	
//soap_server motako objektua sortzen dugu
//$ns="http://localhost/ws18/php/Pasahitzak.php?wsdl";
$ns="https://wsuramos.000webhostapp.com/WS21_Lab6/ws18/ph/Pasahitzak.php?wsdl";
$server = new soap_server;
$server->configureWSDL('pasahitza_Da',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('pasahitza_Da', array('x'=>'xsd:string','y'=>'xsd:string'), array('z'=>'xsd:string'), $ns);

function pasahitza_Da($x, $y){
	$ok = 0;
	$passwords = file("toppasswords.txt");
	foreach($passwords as $pass){
		if(strstr($pass,$x)){
			$ok = 1;
			break;
		}
	}
	if($y != "konprobatu"){
		return "ZERBITZURIK GABE";
	}
	else if($ok == 0){
		return "Onartua";
	}else{
		return "Pasahitz horrek ez du balio";
	}
}

if (!isset( $HTTP_RAW_POST_DATA )) {
	$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);
?>