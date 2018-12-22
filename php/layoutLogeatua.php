<?php session_start(); 

if(empty($_SESSION['user'])){
	echo "<script language='javascript'>window.location='layout.php';</script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quiz Maker</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
     <link rel='stylesheet' type='text/css' href='../styles/horbar.css' />
	<link rel='stylesheet' type='text/css'  media='only screen and (min-width: 530px) and (min-device-width: 481px)'href='../styles/wide.css' />
	<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='../styles/smartphone.css' />		      
 </head>
 

<?php 
				if(empty($_SESSION['sessionmode']) /*|| $_SESSION['sessionmode'] == "admin"*/){
					echo "ZERBITZU HONETARAKO BAIMENIK EZ";
					return false;
				}			
			
?>
 <body>

  <div id='page-wrap'>
      

	     
    <div align='left' id="navegador" role='navigation'>
        <ul>
        <li><?php echo $_SESSION['user'];?> </li>
        </ul>
    </div>
      
      
	<header class='main' id='h1'>
	

	
	<h2>Quiz: crazy questions</h2>
	
	

	
	<span><a href='logout.php'>Logout</a></span>
	
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutLogeatua.php'>Home</a></span>
		<?php
			if($_SESSION['sessionmode']=='user'){
			    $_SESSION['galderaID']=0;
			    $_SESSION['score']=0;
		        //echo "<span><a href='addQuestion.php'>Galdera Sortu</a></span>";
			    //echo "<span> <a href='showQuestion.php'>Galderak Erakutsi</a></span>";
			    echo "<span><a href='quizz.php'>Quizz</a>";
			    echo "<span><a href='handlingQuizesAJAX.php'>HandlingQuizes</a>";
			    echo "<span><a href='pasahitzaAldatu.php'>Pasahitza Aldatu</a></span>";
			}
			if($_SESSION['sessionmode']=='admin'){
		    	echo "<span><a href='handlingAccounts.php'>Kontuak Kudeatu</a></span>";
			}
		?>
		<span><a href='../credits.html'>Credits</a></span>
	</nav>    
	<section class="main" id="s1">
	<div>
		Hemen azalduko da galdera sortzailea hurrengo laboetako batean ...
	</div>
	</section>
	
	<footer class='main' id='f1'>
		 <a href='https://github.com/uramos/ws18'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
