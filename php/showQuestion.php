<?php 
include 'dbConfig.php'

// Konexioa sortu
$link = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$SQL_QUIZ = $link->query("select * from questions");

$emaitza = $connection->query($SQL_QUIZ);

echo '<table border=1><tr><th> Id </th><th> Posta </th><th> Sarrera Galdera </th><th> Sarrera Zuzena </th><th> 
Sarrera Okerra1 </th><th> Sarrera Okerra2 </th><th> Sarrera Okerra3 </th><th> Galdera Zailtasuna </th><th> Galdera Gaia </th></tr>';

if ($emaitza->num_rows > 0) {
	while ($row = $emaitza->fetch_assoc()) {
		echo '<tr><td>'.$row['ID'].'</td> <td>'. $row['PostaElektronikoa'].'</td><td>'.$row['Galdera'].'</td>
		<td>'.$row['ErantzunZuzena'].'</td><td>'.$row['ErantzunOkerra1'].'</td><td>'.$row['ErantzunOkerra2'].'</td>
		<td>'.$row['ErantzunOkerra3'].'</td><td>'.$row['GalderaZailtasuna'].'</td><td>'.$row['GalderaArloa'].'</td></tr>';
	}
} else {
	echo "Errorea: Ez dira galderak aurkitu!";	
}

$connection->close();

?> 