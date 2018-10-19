<?php 
include 'dbConfig.php';

$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);

if ($link->connect_error) {
    die("Connection failed: " . $link1->connect_error);
}
//Kontuz hemen,lokalean question, hodeian Question!!
$sql = ("select * from questions");

$ema = mysqli_query($link,$sql);

echo '<table border=1><tr><th> ID </th><th> EPOSTA </th><th> SARRERA GALDERA </th><th> SARRERA ZUZENA </th><th> 
SARRERA OKERRA 1 </th><th> SARRERA OKERRA 2 </th><th> SARRERA OKERRA 3 </th><th> GALDERA ZAILTASUNA </th><th> GALDERA GAIA </th></tr>';

	while ($row = mysqli_fetch_array($ema,MYSQLI_ASSOC)) {
		echo '<tr><td>' . $row['Id'] . '</td> <td>' . $row['eMail'].'</td><td>'. $row['sarGaldera']. '</td>
		<td>' . $row['sarZuzena'] . '</td><td>' . $row['sarOkerra1'] . '</td><td>' . $row['sarOkerra2'] . '</td>
		<td>'. $row['sarOkerra3'] . '</td><td>' . $row['galderaZail'] . '</td><td>' . $row['galderaGai'] . '</td></tr>';
	}
echo '</table>';
mysqli_free_result($ema);
echo "Atzera bueltatu. " . "<a href=\"javascript:history.go(-1)\">ATZERA</a><br>";
mysqli_close($link);

?> 