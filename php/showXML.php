<?php session_start() ?>
<!DOCTYPE html>
<html>
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



if(!isset($_SESSION['user'])){
	echo "ZERBITZU HONETARAKO BAIMENIK EZ";
	
}else{
    
 ?>
 

<body style="margin-top:50px">
<header id='main-header' >

     
    <div id="navegador" role='navigation'>
     
       <a href='layoutLogeatua.php' style='color:white' >Atzera</a>
        <center><?php echo $_SESSION['user'];?> 
       </center>
    </div>
      
</header>

<?php


	$xml = simplexml_load_file('../xml/questions.xml');
	
	
	
	echo '<table border=1> <tr> <th> Egilea </th> <th> Enuntziatua </th><th> Erantzun zuzena </th></tr>';
	
	foreach($xml->children() as $galdera){
		echo"<tr><td>". $galdera['author'] . "</td><td>". $galdera->itemBody->p ." </td><td>". $galdera->correctResponse->value ."</td></tr>\n";
	}
	echo '</table>';	

}
?>
</body>
</html>