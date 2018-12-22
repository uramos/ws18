<?php
session_start();

//PASA BEHARREKO PARAMETEOAK: GALDERA, SARTUTAKO ERANTZUNA, BALORAZIOA
include 'dbConfig.php';

if (isset($_POST['sarGaldera'])) {
	
	
	
	$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if($link->connect_errno) {
		die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
	}
	
    $gal=$_POST['sarGaldera'];
    $eran=$_POST['sarZuzena'];
    $bal=$_POST['balorazioa'];
    
    $sql="SELECT * FROM questions WHERE sarGaldera='$gal' and sarZuzena='$eran'";
    
	$ema=mysqli_query($link, $sql);
	
	$_SESSION['galderaID']++;
	
	if(mysqli_num_rows($ema)<1) //erantzuna txarto
	{
	    
	     $_SESSION['score']--;
	     if($_SESSION['score']<0){
	         $_SESSION['score']=0;
	     }
	    
		echo "BAD";
		return false;
	}else{//erantzuna ondo
	    
	    $row = mysqli_fetch_array($ema,MYSQLI_ASSOC);
	    
	    $_SESSION['score']+=$row['galderaZail'];
	    
	    if($_SESSION['maxscore']<$_SESSION['score']){
	        
	        $score=$_SESSION['score'];
	        $email=$_SESSION['user'];
	        $sqlu="update erabiltzaile set Score=$score WHERE ePosta='$email'";
    
        	mysqli_query($link, $sqlu);
        	$_SESSION['maxscore']=$_SESSION['score'];
	    }
	    
	    echo "GOOD";
	    
	}
	
	if($bal!='NA'){//baloraziorenbat badago lortu balorazioak
	    
	    $sqlb="SELECT * FROM balorazioak WHERE sarGaldera='$gal'";
    
    	$emab=mysqli_query($link, $sqlb);
	
    	$rowb = mysqli_fetch_array($emab,MYSQLI_ASSOC);
	    
    	if($bal=='Bai'){//eguneratu positiboa
    	    
    	    $neb=$rowb['positibo']+1;
    	    
    	    $sqlb="update balorazioak set positibo=$neb WHERE sarGaldera='$gal'";
    
    	    $emab=mysqli_query($link, $sqlb);
	
    	    
    	    
    	}else if($bal=='Ez'){//eguneratu negatiboa
    	    
    	    $neb=$rowb['negatibo']+1;
    	    
    	    $sqlb="update balorazioak set negatibo=$neb WHERE sarGaldera='$gal'";
    
    	    $emab=mysqli_query($link, $sqlb);
	
    	    
    	}
    	
	}
	

}


?>
