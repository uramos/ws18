<?php 
session_start();


if(!isset($_SESSION['user'])){
	echo "ZERBITZU HONETARAKO BAIMENIK EZ";
	
}else{					


	include 'dbConfig.php';

	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if ($link->connect_error) {
		die("Connection failed: " . $link1->connect_error);
	}
	//Kontuz hemen,lokalean from questions, hodeian Question!!
	$sql = ("select * from questions");

	$ema = mysqli_query($link,$sql);

	echo '<table border=1><tr><th> ID </th><th> EPOSTA </th><th> SARRERA GALDERA </th><th> SARRERA ZUZENA </th><th> 
	SARRERA OKERRA 1 </th><th> SARRERA OKERRA 2 </th><th> SARRERA OKERRA 3 </th><th> GALDERA ZAILTASUNA </th><th> GALDERA GAIA </th><th> IRUDIA </th></tr>';

		while ($row = mysqli_fetch_array($ema,MYSQLI_ASSOC)) {
			//Sourcea image motako data dela adierazten du, base64ean dagoena eta hori kodetu irudia ikusteko ondo.
			$irudi = '<img width=200px src="data:image/*;base64,'.base64_encode( $row['IrudiBin'] ).'"/>';
			echo '<tr><td>' . $row['Id'] . '</td> <td>' . $row['eMail'].'</td><td>'. $row['sarGaldera']. '</td>
			<td>' . $row['sarZuzena'] . '</td><td>' . $row['sarOkerra1'] . '</td><td>' . $row['sarOkerra2'] . '</td>
			<td>'. $row['sarOkerra3'] . '</td><td>' . $row['galderaZail'] . '</td><td>' . $row['galderaGai'] . '</td><td>' . $irudi . '</td></tr>';
		}
	echo '</table>';
	mysqli_free_result($ema);
	echo "<a href='layoutLogeatua.php'>Atzera</a>";
	mysqli_close($link);
	
}
?> 
