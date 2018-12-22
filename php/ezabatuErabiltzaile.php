<?php
include 'dbConfig.php';

$x =$_GET['id'];

if($x=="admin000@ehu.eus"){ echo "Ezin da ezabatu erabiltzaile hau"; return false;}

$link2 = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
        	
        		if ($link2->connect_error) {
        			die("Connection failed: " . $link2->connect_error);}
        		
        		
        		$sqls = ("delete from erabiltzaile where ePosta ='$x'");
        	    	
        		$ema = mysqli_query($link2,$sqls);
        		
                
                echo "Ezabatuta";

?>