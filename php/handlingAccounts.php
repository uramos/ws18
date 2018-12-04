<?php session_start(); ?>
<?php 
				if(isset($_SESSION['sessionmode']) && $_SESSION['sessionmode']=='user'){
					echo "ZERBITZU HONETARAKO BAIMENIK EZ";
					return false;
				}			
?>
<?php
	include 'dbConfig.php';

	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);}
		
	$sql = ("select * from erabiltzaile");

	$ema = mysqli_query($link,$sql);

	echo '<table border=1><tr><th> EPOSTA </th><th> DEITURA </th><th> PASAHITZA </th><th> ARGAZKIA</th><th> BLOKEATUA </th></tr>';

	while ($row = mysqli_fetch_array($ema,MYSQLI_ASSOC)) {
		$posta=$row['ePosta'];
		//Sourcea image motako data dela adierazten du, base64ean dagoena eta hori kodetu irudia ikusteko ondo.
		$irudi = '<img width=200px src="data:image/*;base64,'.base64_encode( $row['Argazkia'] ).'"/>';
		echo "<tr><td>" . $row['ePosta'] . "</td> <td>" . $row['Deitura']."</td><td>". $row['Pass']. "</td>
		<td>" . $irudi . "</td><td>" . $row['Blokeatuta'] . "</td>
		<td> <input type=button name='Aldatu Egoera' value='Aldatu egoera' onclick='blokalda($posta);'/></td></tr>";
	}
	
	echo '</table>';
	mysqli_free_result($ema);
	echo "<a href='layoutLogeatua.php'>Hasiera</a>";
	mysqli_close($link);

?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>	

	function blokalda(id){
		document.write('<?php echo func('+id+')?>');)
	}

</script>

<?php



function func($id){
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$link2 = mysqli_connect($zerbitzaria, $erabiltzaile, $gakoa, $db);
	
		if ($link2->connect_error) {
			die("Connection failed: " . $link2->connect_error);}
		
		
		$sqls = ("select * from erabiltzaile where ePosta ='$id'");
		
		$ema = mysqli_query($link2,$sqls);
		while($row = mysqli_fetch_array($ema, MYSQLI_ASSOC)){
			if ($fila["Blokeatuta"] == 0){
				$blokeatuta = "blokeatuta";
				$sqlu("UPDATE erabiltzaile SET Blokeatuta=1 WHERE ePosta='$id'");
				
				echo "$email kontua blokeatuta";
			}else{
				$sqlu = ("UPDATE erabiltzaile SET Blokeatuta=1  WHERE ePosta='$id'");
			}
		}
		mysqli_close($link2);
	}
	
}
	

?>

<?php

include ("dbConfig.php");

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$link3 = mysqli_connect($zerbitzaria, $erabiltzaile, $gakoa, $db);
	
	if ($link3->connect_error) {
		die("Connection failed: " . $link3->connect_error);}
	
	
	$sqlE = ("delete from erabiltzaile where ePosta ='$id'");
	
	$ema = mysqli_query($link3,$sqlE);
	echo "$email -ren kontua ezabatu egin da. ";
	echo "Freskatu aldaketak ikusteko.";
		
	mysqli_close($link3);
}

?>

