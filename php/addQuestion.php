<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>Galdera sortu</title>

	<link rel="stylesheet" type="text/css" href="../styles/form.css" />
	<link rel="stylesheet" type="text/css" href="../styles/body.css" />
	<link rel="stylesheet" type="text/css" href="../styles/label.css" />
	<link rel="stylesheet" type="text/css" href="../styles/input.css" />
	<link rel="stylesheet" type="text/css" href="../styles/botoia.css" />
	<link rel="stylesheet" type="text/css" href="../styles/thumb.css" />
	<link rel='stylesheet' type='text/css' href='../styles/horbar.css' />
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
    
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
console.log(<?php $_SESSION['user'] ?>);
 $(document).ready(function(){
 
        //$.postaZuzena = function(){
         //   var balioa= $("#posta").val();
           // if (balioa.match((/^[a-zA-Z]{3,20}[0-9]{3}@ikasle\.ehu\.eus$/))){
             //   return true;
            //} else {
              //  return false;
            //}
        //}
		
		function galderaOndo(){
			var balioa = $("#sarGaldera").val();
			var balioaTrim = balioa.trim();
			if(balioaTrim.length>10){
				return true;
			}else{
				return false;
			}
		}
		
        $('#quizMaker').submit(function() {
            if (($("#posta").val()!=="")&& ($("#sarGaldera").val()!=="")&&($("#sarZuzena").val()!=="")&&($("#sarOkerra1").val()!=="")
                &&($("#sarOkerra2").val()!=="")&&($("#sarOkerra3").val()!=="")&&($("#galderaZail").val()!=="") &&($("#galderaGai").val()!=="")){
                //if ($.postaZuzena()) {
                    if ($("#galderaZail").val().match(/^[1-5]$/)){
						if(galderaOndo()){
							return true;
						}else{
							alert("Galderak 10 karaktereko luzera izan behar du gutxienez.");
							return false;
						}
                    } else {
                        alert("Zailtasunak zenbaki osoa izan behar du eta 1-5 artekoa.");
                        return false;
                    }
               //} else{
                 //   alert("Sartutako postak ez ditu baldintzak betetzen.");
                   // return false;
                //}
            } else {
                alert("Bete beharreko guztia bete mesedez.");
                return false;
            }
        })
    })
</script>
	
<form enctype="multipart/form-data" id="quizMaker" name="quizMaker"  action="addQuestion.php" method="post">
	<fieldset>
		<legend>Galdera sortu:</legend>
			<label for="posta">eMail(*):</label>
			<input type="text" name="posta" id="posta" value="<?php $_SESSION['user']?>"/>
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

			<label for="botoia"></label>
			<input id="botoia" name="submit" type="submit" value="Bidali" >
			<input type="reset" value="Borratu" id="reset">
			
			
	</fieldset>
	<p> <a href='layoutLogeatua.php'>Atzera</a>";
	
	<?php
		

		if (isset($_POST['sarGaldera'])){
			include 'dbConfig.php';
			$link= new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

			if($link->connect_errno) {
				die( "Huts egin du konexioak MySQL-ra: (". $link-> connect_errno .") " .$link-> connect_error);
			}

			if(empty($_FILES['irudi']['name'])){
				$bin_nom_tmp = "../NoImage.png";
				$binario_contenido = addslashes(fread(fopen($bin_nom_tmp, "rb"), filesize($bin_nom_tmp)));
			}else{
				$bin_nom_tmp = $_FILES['irudi']['tmp_name'];
				$binario_contenido = addslashes(fread(fopen($bin_nom_tmp, "rb"), filesize($bin_nom_tmp)));
			}


			$posta = $_POST['posta'];
			$sarGaldera=$_POST['sarGaldera'];
			$sarZuzena = $_POST['sarZuzena'];
			$sarOkerra1 = $_POST['sarOkerra1'];
			$sarOkerra2 = $_POST['sarOkerra2'];
			$sarOkerra3 = $_POST['sarOkerra3'];
			$galderaZail = $_POST['galderaZail'];
			$galderaGai = $_POST['galderaGai'];  
			
			/*
			if($sarZuzena==$sarOkerra1 ||$sarZuzena==$sarOkerra2 ||$sarZuzena==$sarOkerra3 ||$sarOkerra1==$sarOkerra2 ||$sarOkerra1==$sarOkerra3 ||$sarOkerra2==$sarOkerra3 ){
			    echo "REPEATEDANSERS";
			    return false;
			}
			
			$sqlc="select * from questions where sarZuzena=$sarZuzena and sarOkerra1=$sarOkerra1 sarOkerra2=$sarOkerra2 sarOkerra3=$sarOkerra3 galderaGai=$galderaGai";
			$emac=mysqli_query($link,$sqlc);
			
        	while ($rowc = mysqli_fetch_array($emac,MYSQLI_ASSOC)){
        	    if($row['sarGarldera']==$sarGaldera){
        	        echo "REPEATEDQUESTION";
        	        return false;
        	    }
        	}
			*/
			
			$sqlc="select * from questions where salGaldera=$sarGaldera";
			$emac=mysqli_query($link,$sqlc);
			
			$count = $emac->num_rows;
			
			
			$erregistratua=mysqli_query($link, "SELECT * FROM questions WHERE sarGaldera='$sarGaldera'");
        	if(mysqli_num_rows($erregistratua)>0)
        	{
        	    echo "REPEAT";
        		return false;
        	}
	

                   
			//if (preg_match('/^[a-zA-Z]{3,20}[0-9]{3}@ikasle\.ehu\.eus$/',"$posta")) {
			if(strlen(trim($sarGaldera))>10){
				if(strlen(trim($sarZuzena))>0 and strlen(trim($sarOkerra1))>0 and strlen(trim($sarOkerra2))>0 and strlen(trim($sarOkerra3))>0 and strlen(trim($galderaGai))>0){
					if (preg_match('/^[1-5]$/',"$galderaZail")) {
						
						$sql = "INSERT INTO questions (eMail, sarGaldera, sarZuzena, sarOkerra1, sarOkerra2, sarOkerra3, galderaZail, galderaGai, IrudiBin) 
						VALUES ('$posta', '$sarGaldera', '$sarZuzena','$sarOkerra1','$sarOkerra2','$sarOkerra3','$galderaZail','$galderaGai', '$binario_contenido')";

						$ema=mysqli_query($link,$sql);

						if(!$ema){
							die('Errorea query-a gauzatzerakoan: ' . mysqli_error($link));
						}

						echo "Galdera bat gehitu da datu-basera. <br>";
						
						
						//xml kargatu
						$xml=simplexml_load_file('../xml/questions.xml');
						if($xml == false){
							echo "Errorea XML-a kargatzean.";
							return false;
						}
							
						$galdera = $xml->addChild('assesmentItem');
						
						$galdera->addAttribute('author',$_POST['posta']);
						$galdera->addAttribute('subject',$_POST['galderaGai']);
						
						$iBody = $galdera->addChild('itemBody');
						$iBody->addChild('p', $_POST['sarGaldera']);		
						$cResponse = $galdera->addChild('correctResponse');
						$cResponse->addChild('value', $_POST['sarZuzena']);		
						$iResponse = $galdera->addChild('incorrectResponses');
						$iResponse->addChild('value', $_POST['sarOkerra1']);
						$iResponse->addChild('value', $_POST['sarOkerra2']);
						$iResponse->addChild('value', $_POST['sarOkerra3']);
						
						$xml->asXML('../xml/questions.xml');
						
						echo "Sortu diren galderak ikusteko. " . "<a href=\"showXML.php\">GALDERAK</a>";
			 
					}else{
						  echo "alert('Zailtasunak zenbaki osoa izan behar du eta 1-5 artekoa.');";
					}
				}else{
					 echo "alert('Bete beharreko guztia bete mesedez.');";
				}
			}else{
				echo "alert('Galderak 10 karaktereko luzera izan behar du gutxienez.');";
			}
			//}else{
			  // echo "alert('Sartutako postak ez ditu baldintzak betetzen.');";
			//}
			
			 
			mysqli_close($link);

		}
?>
</form>


<footer class='main' id='f2'>
	<a href="javascript:history.back(-1);">Atzera</a>
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