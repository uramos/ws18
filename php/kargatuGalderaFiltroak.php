<?php
include 'dbConfig.php';

            $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
            	
            		if ($link->connect_error) {
            			die("Connection failed: " . $link->connect_error);}
            		
            		
            		$sqls = ("select DISTINCT galderaGai from questions");
            	
            		
            		$ema = mysqli_query($link,$sqls);
            		
            		//$rows_cnt = $ema->num_rows;
            	
            		while ($row = mysqli_fetch_array($ema,MYSQLI_ASSOC)) {
            		    echo "<option value=".$row['galderaGai'].">".$row['galderaGai']."</option>";
            		 }
?>