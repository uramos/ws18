<?php 
session_start();


if(!isset($_SESSION['user'])){
	echo "ZERBITZU HONETARAKO BAIMENIK EZ";
	
}else{					

?>
<head>
<style type="text/css">
#main-header {
	background: #333;
	color: white;
	height: 40px;
	
	width: 100%; 
	left: 0; 
	top: 0; 
	position: fixed; 
}
</style>
</head>

<?php
	include 'dbConfig.php';

	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if ($link->connect_error) {
		die("Connection failed: " . $link1->connect_error);
	}
	//Kontuz hemen,lokalean from questions, hodeian Question!!
	$sql = ("select * from questions");

	$ema = mysqli_query($link,$sql);

?>
<body>
<body style="margin-top:50px">
<header id='main-header' >

     
    <div id="navegador" role='navigation'>
     
       <a href='layoutLogeatua.php' style='color:white' >Atzera</a>
        <center><?php echo $_SESSION['user'];?> 
       </center>
    </div>
      
</header>
<?php
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

	mysqli_close($link);
	
}
?> 
</body>