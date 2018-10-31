<?php
include 'dbConfig.php';

#hau ere lerro bateko iruzkina
/*Oraingoan zenbait lerrotan barrena 
Luzatzen da, argi dago? */

$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($link->connect_errno) {
	die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
}

if(empty($_FILES['irudi']['name'])){
	$bin_nom_tmp = "../NoImage.png";
	$binario_contenido = addslashes(fread(fopen($bin_nom_tmp, "rb"), filesize($bin_nom_tmp)));
}else{
	$bin_nom_tmp = $_FILES['irudi']['tmp_name'];
	$binario_contenido = addslashes(fread(fopen($bin_nom_tmp, "rb"), filesize($bin_nom_tmp)));
}

//Kontuz hemen,lokalean into question, hodeian Question!!
$sql = "INSERT INTO questions (eMail, sarGaldera, sarZuzena, sarOkerra1, sarOkerra2, sarOkerra3, galderaZail, galderaGai, IrudiBin) 
VALUES ('$_POST[posta]', '$_POST[sarGaldera]', '$_POST[sarZuzena]', '$_POST[sarOkerra1]', '$_POST[sarOkerra2]', '$_POST[sarOkerra3]', '$_POST[galderaZail]', '$_POST[galderaGai]', '$binario_contenido')";

$ema=mysqli_query($link,$sql);

if(!$ema){
	die('Errorea query-a gauzatzerakoan: ' . mysqli_error($link));
}

echo "Galdera bat gehitu da datu-basera. <br>";
echo "Atzera bueltatu eta galdera berri bat sortzeko. " . "<a href=../layoutLogeatua.html>ATZERA</a><br>";
echo "Sortu diren galderak ikusteko. " . "<a href=\"showQuestion.php\">GALDERAK</a>";
 
mysqli_close($link);
?>