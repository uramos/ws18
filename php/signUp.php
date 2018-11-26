<html>

<head>
	
	<title>Erregistroa</title>
	
	<style>
          .thumb {
            height: 300px;
			width: 540px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }
    </style>	
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
	
 $(document).ready(function(){
	 postaZuzena = function(){
            var balioa= $("#posta").val();
            if (balioa.match((/^[a-zA-Z]{3,20}[0-9]{3}@ikasle\.ehu\.eus$/))){
                return true;
            } else {
                return false;
            }
        }

		function deiturakOndo(){
			var balioa = $("#deitura").val();
			var balioaTrim = balioa.trim();
			if(balioaTrim.length>2){
				return true;
			}else{
				return false;
			}
		}
			
			
			
		var xhro1 = new XMLHttpRequest();
		xhro1.onreadystatechange = function(){
		
				if((xhro1.readyState==4)&&(xhro1.status==200)){ //dena zuzen
				
					var ema1 = xhro1.responseText;
					
					if(ema1 == "BAI"){//matrikulatuta badago
						
						document.getElementById("matrikulatua").innerHTML = "Matrikulatuta"
						
					}else{//ezezkoan
						
						document.getElementById("matrikulatua").innerHTML = "Matrikulatu gabea"

					}
				}
				
	}
	var xhro2 = new XMLHttpRequest();
	
	xhro2.onreadystatechange = function(){ 
	
				if((xhro2.readyState==4)&&(xhro.status==200)){ //dena ondo
				
					var ema2 = xhro2.responseText;
					
					if(ema2 == "BALIOZKOA"){ //passahitza ona bada
						
						document.getElementById("password2").innerHTML = "Sartu duzun pasahitza egokia da."
						
					}else if (ema2 =="BALIOGABEA"){//pasahitza txarra bada
					
						document.getElementById("password2").innerHTML = "Sartu duzun pasahitza ez da egokia."
						
					}else{//bestela
						
						document.getElementById("password2").innerHTML = "Tiket okerra."
						
					}
				}
	}
	
			function ikasgaian(){
				
				var posta = $("#posta").val();
				
				xhro1.open("GET","Matrikulatuak.php?posta="+ posta, true);
				
				xhro1.send();
			}
	
			function pasahitzaOndo(){
				
				var pass = $("#password").val();
				
				xhro2.open("POST","bezeroPass.php", true);
				
				xhro2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				
				xhro2.send("password="+password);
			}
			
			
			
			
			
		
	      $("#signUp").submit(function()  {
			  
			  var b1 = xhro.responseText;
			  var b2 = xhro2.responseText;
			  
            if (($("#posta").val()!=="")&& ($("#password").val()!=="")&&($("#deitura").val()!=="")&&($("#password2").val()!=="")){
                if (postaZuzena()) {
                    if ($("#password").val() == $("#password2").val()){
						if(deiturakOndo()){
							
							if(b1 != "BAI" || b2 != "BALIOZKOA"){
								
								alert("Erregistratzea debekatua.");
								
								return false;
							}
							
							
							return true;
							
							
						}else{
							alert("Zure izen abizenak idatzi.");
							return false;
						}
					}else{
                    alert("Pasahitzak ez dira berdinak.");
                    return false;
					}
                }else{
                    alert("Sartutako postak ez ditu baldintzak betetzen.");
                    return false;
				}
            }else {
                alert("Bete beharreko guztia bete mesedez.");
                return false;
			}
        })	
  });
</script>
	
	
</head>


<body style="margin-top:100px"> 
<center>
<form action="signUp.php" method="post" id="signUp" name="signUp">

    <div class="loginform">
    <div class="form-label"><label for="posta"  >Posta Elektronikoa</label></div>
    <div class="form-input">
		<input type="text" name="posta" id="posta" size="15" onchange="ikasgaian()">
    </div>
	<div class="form-label"><label for="username">Izen Abizenak</label></div>
    <div class="form-input">
		<input type="text" name="username" id="username" size="15" pattern="([A-Z][a-z]{1,150}\s)*([A-Z][a-z]{1,150}\s)([A-Z][a-z]{1,150})" title="Izen eta Abizenak letra larriz hasi mesedez." value="">
    </div>
    <div class="clearer"><!-- --></div>
    <div class="form-label"><label for="password">Pasahitza</label></div>
    <div class="form-input">
		<input type="password" name="password" id="password" size="15" pattern="([A-Za-z0-9]{8,16})" title="pasahitzak gutxienez 8 karaktere." onchange="pasahitzaOndo()">
    </div>
	<div class="clearer"><!-- --></div>
	<div class="form-label"><label for="password2">Errepikatu Pasahitza</label></div>
    <div class="form-input">
		<input type="password" name="password2" id="password2" size="15">
    </div>
    </div>

	<div class="form-label"><label for="argazki">Aukeratu argazki bat</label></div>
		<input type="file" id="files" name="argazki"  />
	<br />
	<output id="lists" name="lists"  ></output>
		  
	<br />
    <input id="anchor" type="hidden" name="anchor" value="">
    <script>document.getElementById('anchor').value = location.hash</script>
    <input type="submit" name="submit" id="loginbtn" value="Erregistratu">
	<input type="reset" id="reset" value="Ezabatu"/><br><br>
    
	<span id="matrikulatua"></span><br>
	<span id="pasahitza2"></span>

</form>

</center>

<script> //irudia
            function archivo(evt) {
                var files = evt.target.files; // FileList object
             
                // Obtenemos la imagen del campo "file".
                for (var i = 0, f; f = files[i]; i++) {
					//Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("lists").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                }
            }
             
            document.getElementById('files').addEventListener('change', archivo, false);
			
      </script>

</body>

</html>





<?php
include 'dbConfig.php';

#hau ere lerro bateko iruzkina
/*Oraingoan zenbait lerrotan barrena           
Luzatzen da, argi dago? */
if (isset($_POST['submit'])) { 
$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($link->connect_errno) {
	die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
}

if(empty($_FILES['argazki']['name'])){
	
$bin_nom_tmp = "../NoImage.png";
$binario_contenido = addslashes(fread(fopen($bin_nom_tmp, "rb"), filesize($bin_nom_tmp)));

}else{

$bin_nom_tmp = $_FILES['argazki']['tmp_name'];

$binario_contenido = addslashes(fread(fopen($bin_nom_tmp, "rb"), filesize($bin_nom_tmp)));

}
$sql = "INSERT INTO erabiltzaile (ePosta, Deitura, Pass, Argazkia)
VALUES ('$_POST[posta]', '$_POST[username]',  '$_POST[password]','$binario_contenido')";

$ema = mysqli_query($link,$sql);
if(!$ema){
	die('Errorea query-a gauzatzerakoan: ' . mysqli_error($link));
}else{
	mysqli_close($link);

}

echo "Erabiltzaile bat gehitu da datu-basera. <br>";
echo "Hasierara bueltatzeko" . "<a href=../layout.html>ATZERA</a><br>";

}
?>




