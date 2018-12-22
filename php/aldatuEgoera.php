<?php
include 'dbConfig.php';

$x =$_GET['id'];

$link2 = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
        	
        		if ($link2->connect_error) {
        			die("Connection failed: " . $link2->connect_error);}
        		
        		
        		$sqls = ("select * from erabiltzaile where ePosta ='$x'");
        	
        		
        		$ema = mysqli_query($link2,$sqls);
        		$res='2';
        		
        		while($row = mysqli_fetch_array($ema, MYSQLI_ASSOC)){
        		 
        			if ($row["Blokeatuta"] == 0){
        				$sqlu = "UPDATE erabiltzaile SET Blokeatuta=1 WHERE ePosta = '$x'";
        				$ema2=mysqli_query($link2,$sqlu);
        				//echo "$x kontua blokeatuta";
        				$res="1";
        			}else{
        				$sqlu = "UPDATE erabiltzaile SET Blokeatuta=0  WHERE ePosta = '$x'";
        				//echo "$x kontua desblokeatuta";
        				$ema2=mysqli_query($link2,$sqlu);
        				$res="0";
        			}
        		}
        		mysqli_close($link2);
             
                
                echo $res;

?>