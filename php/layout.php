<?php
session_start();

if(isset($_SESSION['user'])){
	echo "<script language='javascript'>window.location='layoutLogeatua.php';</script>";
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quiz Maker</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />		      
 </head>

 
 <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right"><a href='Login.php'>LogIn</a> </span>
	  <span class="right"><a href='signUp.php'>Erregistratu</a> </span>
      <span class="right" style="display:none"><a href="/logout">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<!--<span><a href='pasahitzaAldatu.php'>Password Recovery</a></span>-->
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
