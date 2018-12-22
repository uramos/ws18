<?php	
	include 'dbConfig.php';
	session_start();
	if(isset($_POST['posta'])){
	$usr_email=$_POST['posta'];
	$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	if($link->connect_errno) {
		die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
	}
	
	$usr_pass=$_POST['pasahitza'];
	

 
	$sql = ("select * from erabiltzaile where ePosta='$usr_email'");
	
	$ema = mysqli_query($link,$sql);
	

	
	
	
	if(!$ema){
		die('Errorea query-a gauzatzerakoan: ' . mysqli_error($link));
	}else{	
	    

		$rows_cnt = $ema->num_rows;
		mysqli_close($link);
		if($rows_cnt==1 ){
		    
		    
		    $row = mysqli_fetch_array($ema,MYSQLI_ASSOC);
		    
		    if(password_verify($usr_pass, $row['Pass'])){
		    
    		    if(!$row['Blokeatuta']){
        			$rows_cnt=0;
        			//sesioa hasieratu
        			//session_start();
        			$_SESSION['user']=$usr_email;
        			
        			//puntuazioak
        			$_SESSION['score']=0;
        			$_SESSION['maxscore']=$row['Score'];
        			$_SESSION['galderaID']=0;
        			
                    
                    if($usr_email == 'admin000@ehu.eus'){
    					$_SESSION['sessionmode']='admin';
                        echo"<p>Special access granted<p> <a href='layoutLogeatua.php'>Logeatu zara</a>";
                    }else{
    					$_SESSION['sessionmode']='user';
        		    	echo"<p> Access granted<p> <script language='javascript'>window.location='layoutLogeatua.php'</script>;";
    				}
    		    }else{
    		        	echo"<p><font color=#FF3300> ERABILTZAILE BLOKEATUA !</font><p>";
    		    }
    		}else{
    		    	echo"<p><font color=#FF3300> Autentidfikazio errorea! Saiatu berriro</font><p>";
    		}
		}else{
			echo"<p><font color=#FF3300> Erabiltzaile hori ez dago erregistratuta! Saiatu berriro</font><p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
	
<?php 
				if(isset($_SESSION['user'])){
					echo "ZERBITZU HONETARAKO BAIMENIK EZHEMEN?";
					return false;
				}//else if(isset($_SESSION['admin'])){
				    
				//}
			
?>

<body>
<h2> Erabiltzaileak Login egin</h2>
	<form method="post" action="Login.php" id="erablogin" name="erablogin">
		<fieldset >
			<legend>ID panela:</legend>
			Email: <input type="email" id="posta" name="posta"  value="" size="30"/><p>
			Password:  <input type="password" id="pasahitza" name="pasahitza" size="30"/><p>
			<input type="submit" value="Login Egin" id="submita" name="submita"/>  <p> <a href='pasahitzaAhaztuta.php'>Pasahitza ahaztu duzu?</a></br>
		</fieldset>
        <p> <a href='layout.php'>Atzera</a>

	</form>
</body>
</html>

