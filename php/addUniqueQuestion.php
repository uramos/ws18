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
						
						$sqlb = "INSERT INTO balorazioak (sarGaldera) 
						VALUES ('$sarGaldera')";

						$emab=mysqli_query($link,$sqlb);
						
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
			
			echo "DONE";
			mysqli_close($link);

		}
?>