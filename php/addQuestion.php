<?php
include 'dbConfig.php';

#hau ere lerro bateko iruzkina
/*Oraingoan zenbait lerrotan barrena 
Luzatzen da, argi dago? */

$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($link->connect_errno) {
	die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
}
echo "Konexioa egin da:" . $link->host_info;

$sql = "INSERT INTO questions (eMail, sarGaldera, sarZuzena, sarOkerra1, sarOkerra2, sarOkerra3, galderaZail, galderaGai) 
VALUES ('$_POST[posta]', '$_POST[sarGaldera]', '$_POST[sarZuzena]', '$_POST[sarOkerra1]', '$_POST[sarOkerra2]', '$_POST[sarOkerra3]', '$_POST[galderaZail]', '$_POST[galderaGai]')";

$ema=mysqli_query($link,$sql);

if(!$ema){
	die('Errorea query-a gauzatzerakoan: ' . mysqli_error());
}

echo "Erregistro bat gehitu da.";
 
mysqli_close($link);
