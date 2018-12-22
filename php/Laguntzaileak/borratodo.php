<?php
include 'dbConfig.php';

$link2 = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
        	
        		if ($link2->connect_error) {
        			die("Connection failed: " . $link2->connect_error);}
        		
        		
        		$sqls = ("delete from questions");
        	    	
        		$ema = mysqli_query($link2,$sqls);
        		
                
                echo "Ezabatuta";

?>