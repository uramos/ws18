<!DOCTYPE html>
<html>
<body>
<?php
	$xml = simplexml_load_file('../xml/questions.xml');
	
	echo '<table border=1> <tr> <th> Egilea </th> <th> Enuntziatua </th><th> Erantzun zuzena </th></tr>';
	
	foreach($xml->children() as $galdera){
		echo"<tr><td>". $galdera['author'] . "</td><td>". $galdera->itemBody->p ." </td><td>". $galdera->correctResponse->value ."</td></tr>\n";
	}
	echo '</table>';	
	echo "<p> <a href=javascript:history.back(-1);>Atzera</a>";
?>
</body>
</html>