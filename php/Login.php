<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<link rel='stylesheet' type='type/css' href='styles/style.css'/>
</head>
	
<body>
<h2> Erabiltzaileak Login egin</h2>
	<form method="post" action="Login.php" id="erablogin" name="erablogin">
		<fieldset >
			<legend>ID panela:</legend>
			Email: <input type="email" id="posta" name="posta"  value="" size="30"/><p>
			Password:  <input type="password" id="pasahitza" name="pasahitza" size="30"/><p>
			<input type="submit" value="Login Egin" id="submita" name="submita"/></br>
		</fieldset>
	</form>
</body>
</html>

<?php	
	include 'dbConfig.php';
	
if(isset($_POST['posta'])){
	$usr_email=$_POST['posta'];
	$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	if($link->connect_errno) {
		die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
	}
	$usr_pass=$_POST['pasahitza'];
	
	$sql = ("select * from erabiltzaile where ePosta='$usr_email' and pass='$usr_pass'");
	
	$ema = mysqli_query($link,$sql);
	
	if(!$ema){
		die('Errorea query-a gauzatzerakoan: ' . mysqli_error($link));
	}else{
		$rows_cnt = $ema->num_rows;
		mysqli_close($link);
		if($rows_cnt==1){
			$rows_cnt=0;
			echo"<p> Access granted<p> <a href='../layoutLogeatua.html'>Logeatu zara</a>";
		}else{
			echo"<p><font color=#FF3300> Autentidfikazio errorea! Saiatu berriro</font><p>";
		}
	}
}
?>