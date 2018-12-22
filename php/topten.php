<?php

include 'dbConfig.php';

    $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
                	
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);}
    		
    $sqls = ("select ePosta, Deitura, Score from erabiltzaile order by Score DESC LIMIT 10");
    
   // $sqls = ("select * from erabiltzaile order by ePosta");
    
    $ema = mysqli_query($link,$sqls);
    
    
    
    echo "<body style='margin-top:50px'>";
    echo "<center>";
    
    	echo '<table border=1><tr><th> EPOSTA </th><th> DEITURA </th><th> PUNTUAZIOA </th></tr>';

   // $i="0";
   $i=1;
		while ($row = mysqli_fetch_array($ema,MYSQLI_ASSOC)) {
		    /*
	    	if($i=="0"){
			    $irudi = '<img width=40px src="../images/primero.png"/>';
			    $i="1";
			}else if($i=="1"){
			    $irudi = '<img width=40px src="../images/segundo.png"/>';
			    $i="2";
			}else if($i=="2"){
		    	$irudi = '<img width=40px src="../images/tercero.png"/>';
		    	$i="3";
		    }else
		    if($i=="3"){
		        $irudi="";
		        $i="4";
		    }*/
		    
		    
		    if($i==1){
			    $irudi = '<img width=35px src="../images/primero.png"/>';
			   
			}else if($i==2){
			    $irudi = '<img width=35px src="../images/segundo.png"/>';
			    
			}else if($i==3){
		    	$irudi = '<img width=35px src="../images/tercero.png"/>';
		    
		    }else
		    if($i>3){
		        $irudi=$i;
		        
		    }
			$i++;
			
			
			echo '<tr><td>' . $row['ePosta'] . '</td> <td>' . $row['Deitura'].'</td><td>'. $row['Score']. '</td><td>
			 '.$irudi.' </td></tr>';


		}
	echo '</table>';
	echo "</center>";
	echo "</body>";
	mysqli_free_result($ema);

	mysqli_close($link);
?>