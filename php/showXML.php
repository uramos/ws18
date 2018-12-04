<?php session_start() ?>
<!DOCTYPE html>
<html>
<body>
<?php



if(!isset($_SESSION['user'])){
	echo "ZERBITZU HONETARAKO BAIMENIK EZ";
	
}else{
	$xml = simplexml_load_file('../xml/questions.xml');
	
	echo '<table border=1> <tr> <th> Egilea </th> <th> Enuntziatua </th><th> Erantzun zuzena </th></tr>';
	
	foreach($xml->children() as $galdera){
		echo"<tr><td>". $galdera['author'] . "</td><td>". $galdera->itemBody->p ." </td><td>". $galdera->correctResponse->value ."</td></tr>\n";
	}
	echo '</table>';	
	echo "<p> <a href='layoutLogeatua.php'>Atzera</a>";
}
?>
</body>
</html>