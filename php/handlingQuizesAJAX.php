<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Galdera sortu</title>

	<link rel="stylesheet" type="text/css" href="../styles/form.css" />
	<link rel="stylesheet" type="text/css" href="../styles/body.css" />
	<link rel="stylesheet" type="text/css" href="../styles/label.css" />
	<link rel="stylesheet" type="text/css" href="../styles/input.css" />
	<link rel="stylesheet" type="text/css" href="../styles/botoia.css" />
	<link rel="stylesheet" type="text/css" href="../styles/thumb.css" />
	<link rel='stylesheet' type='text/css' href='../styles/horbar.css' />
	
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	<script >
    var gal = new XMLHttpRequest();
    
    
	$(document).ready(function(){
		
		function galderaOndo(){
			var balioa = $("#sarGaldera").val();
			var balioaTrim = balioa.trim();
			if(balioaTrim.length>10){
				return true;
			}else{
				return false;
			}
		}
		
		$("#galdSortu").click(function(){
			if (($("#sarGaldera").val()!=="")&&($("#sarZuzena").val()!=="")&&($("#sarOkerra1").val()!=="")
				&&($("#sarOkerra2").val()!=="")&&($("#sarOkerra3").val()!=="")&&($("#galderaZail").val()!=="") &&($("#galderaGai").val()!=="")){
				if ($("#galderaZail").val().match(/^[1-5]$/)){
					if(galderaOndo()){
						
						
						/*
						$.ajax({
						type: "POST",
						url: "addQuestion.php",
						data: $("#quizMaker").serialize(),
						success: function(){
							loadDoc()
						}	
						});
						
						*/
						
						gal.open("POST","addUniqueQuestion.php",true);
						gal.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	                    gal.send($("#quizMaker").serialize());
						
						
						return true;
					}else{
						alert("Galderak 10 karaktereko luzera izan behar du gutxienez.");
						return false;
					}
				} else {
					alert("Zailtasunak zenbaki osoa izan behar du eta 1-5 artekoa.");
					return false;
				}
			}else {
				alert("Bete beharreko guztia bete mesedez.");
				return false;
			}
		});
	});
		
	function loadDoc() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
	    	if (this.readyState == 4 && this.status == 200) {
		    	myFunction(this);
		    }
	    };
	    xhttp.open("GET",'../xml/questions.xml',true);
	    xhttp.send();
	}
	</script>
	
	<script >
	
	gal.onreadystatechange = function() {
	    	if (gal.readyState == 4 && gal.status == 200) {
	    	    console.log("erantzuna: "+gal.responseText);
	    	     if(gal.responseText=="REPEAT"){
	                alert("Galdera errepikatua sartu duzu.");
	                return false;
	             }
	         }else{
		    	loadDoc();
		    }
	    
	};
	
	
	function myFunction(xml) {
	    

	    
	    
			var i;
			var xmlDoc = xml.responseXML;
			var table="<tr><th>Egilea</th><th>Galdera</th><th>Erantzun Zuzena</th></tr>";
			var x = xmlDoc.getElementsByTagName("assessmentItem");
			console.log("2");
			
			var nodoak = xmlDoc.getElementsByTagName("assessmentItems")[0].childNodes;
			//console.log(nodoak.length)
			//console.log(nodoak[0]);
			//console.log(nodoak[1]);
			//console.log(nodoak[2]);
			
			for (i = 1; i < nodoak.length; i++) {
				

				if(nodoak[i].nodeType == 1){
					if (nodoak[i].getAttribute("author") == "<?php echo $_SESSION['user']?>"){
						
						table += "<tr><td>" +
						nodoak[i].getAttribute("author")+ "</td><td>" +
						nodoak[i].getElementsByTagName("p")[0].childNodes[0].nodeValue +"</td><td>" +
						nodoak[i].getElementsByTagName("value")[0].childNodes[0].nodeValue +"</td></tr>";
					    //console.log(nodoak[i].getAttribute("p"));
					}
				}
			}
			console.log("4");
			document.getElementById("galdTaula").innerHTML = table;
			return true;
			}
	</script>

</head>

<?php 
				if(empty($_SESSION['sessionmode']) || $_SESSION['sessionmode'] == "admin"){
					echo "ZERBITZU HONETARAKO BAIMENIK EZ";
					return false;
				}			
			
?>




<body>
 
	     
    <div align='left' id="navegador" role='navigation'>
        <ul>
        <li><?php echo $_SESSION['user'];?> </li>
        </ul>
    </div>
    
    
<form enctype="multipart/form-data" id="quizMaker" name="quizMaker" method="post">
	<fieldset>
		<legend>Galdera sortu:</legend>
			

			<label for="posta">eMail(*):</label>
			<input type="text" name="posta" id="posta" value="<?php  echo $_SESSION['user']?>" />
			<br/>
			<label for="sarGaldera">Egin nahi den galdera(*):</label>
			<input type="text" name="sarGaldera" pattern="[A-Za-z ,-?]{10,150}" class="sarrera" id="sarGaldera"/>
			<br/>
			<label for="sarZuzena">Erantzun zuzena(*):</label>
			<input type="text" name="sarZuzena" class="sarrera" id="sarZuzena"/>
			<br/>
			<label for="sarOkerra1">Erantzun okerra1(*):</label>
			<input type="text" name="sarOkerra1" class="sarrera" id="sarOkerra1"/>
			<br/>
			<label for="sarOkerra2">Erantzun okerra2(*):</label>
			<input type="text" name="sarOkerra2" class="sarrera" id="sarOkerra2"/>
			<br/>
			<label for="sarOkerra3">Erantzun okerra3(*):</label>
			<input type="text" name="sarOkerra3" class="sarrera" id="sarOkerra3"/>
			<br/>
			<label for="galderaZail">Galderaren zailtasuna maila(1-5)(*):</label>
			<input type="galderaZail" name="galderaZail" id="galderaZail"/>
			<br/>
			<label for="galderaGai">Galderaren gai-arloa(*):</label>
			<input type="text" name="galderaGai" id="galderaGai"/>
			<br/>
					
			<input type="file" id="files" name="irudi" />
			<br />
			<output id="lists" name="lists"></output>

			<input type="reset" value="Borratu" id="reset">
			<br>
			<br>
			<br>
			<button type="button" onclick="loadDoc()">Erakutsi galderak</button>
			<button type="button" id="galdSortu" value="Galdera sortu" >Galdera sortu</button>
			
	</fieldset>
	
	
</form>
<p> <a href='layoutLogeatua.php'>Atzera</a>

<center>
<table id="galdTaula" >
		<tr><th>Erabiltzaileek sortutako galderak hemen:</th></tr>
</table>
</center>

	<footer class='main' id='f2'>
	
	</footer>
	
	<script>
            function archivo(evt) {
                var files = evt.target.files;
             
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