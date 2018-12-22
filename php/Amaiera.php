<?php
session_start();

if(!isset($_SESSION['user'])){
	echo "<script language='javascript'>window.location='layout.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
		 
</head>
 
<body>
    <center>
        <h1>Jokoa amaitu da.</h1>
        <section>
            Zure Puntuazioa: 
            <span id='unekoscore'><?php echo $_SESSION['score']?></span>
        </section>
        <span><a href='layoutLogeatua.php'>Hasiera</a></span>
    </center>
</body>
</html>