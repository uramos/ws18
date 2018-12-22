<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	

</head>
	

<?php 
				if(empty($_SESSION['sessionmode']) || $_SESSION['sessionmode'] == "admin"){
					echo "ZERBITZU HONETARAKO BAIMENIK EZ";
					return false;
				}			
			
?>

<body>
    <center>
        <h2> Aldatu zure pasahitza</h2>
        <form action="pasahitzaAldatu.php" method="post" id="aldatu" name="aldatu">
        Uneko pasahitza: <input type="password" id="oldpass" name="posta"  value="" size="30"/><p>
        Pasahitz berria: <input type="password" id="newpass" name="posta"  size="30" pattern="([A-Za-z0-9]{8,16})" title="pasahitzak gutxienez 8 karaktere." onchange="pasahitzaOndo()"/><p>
        Errepikatu pasahitz berria: <input type="password" id="newpass2" name="posta" size="30"/><p>
        <input type="submit" class="change" name="aldatu" value="Aldatu Pasahitza"/><br><br>	
        <span id="pasahitza"></span><br>
        </form>
    </center>
    <p> <a href='layoutLogeatua.php'>Atzera</a>


<script>

   	var xhro2 = new XMLHttpRequest();
	
	function pasahitzaOndo(){
		
		var pass = $("#newpass").val();
		
		xhro2.open("GET","bezeroPass.php?pass="+pass, true);
		
		xhro2.send();
	}
	
	xhro2.onreadystatechange = function(){ 
	
	    console.log(xhro2.readyState);
    	console.log(xhro2);
	
		if((xhro2.readyState==4)&&(xhro2.status==200)){
		
		var ema2 = xhro2.responseText;
		console.log(xhro2.responseText);

			if(ema2 == "Onartua"){
									
				document.getElementById("pasahitza").innerHTML = "Pasahitz egokia."
									
			}else{
								
				document.getElementById("pasahitza").innerHTML = "Sartu duzun pasahitza ez da egokia."
			}
		}
	}
    

	        
    var xhro = new XMLHttpRequest();

    $(document).on('click', '.change', function (event) {
            
        var oldpass = document.getElementById("oldpass").value;
        var newpass = document.getElementById("newpass").value;
        var newpass2 = document.getElementById("newpass2").value;
          
        if(oldpass!="" && newpass!=""&&newpass2!=""){
         
    		xhro.open("POST","changePass.php", false);
        	xhro.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhro.send("oldpass="+oldpass+"&&newpass1="+newpass+"&&newpass2="+newpass2);
        }
        
    
        xhro.onreadystatechange = function(){
            console.log(xhro.readyState);
        	console.log(xhro);
        	 
            if(xhro.readyState==4 && xhro.status == 200){
                console.log(xhro.responseText);
    	        console.log(xhro2.responseText);
        	}
        }
    	  
    	var b = xhro.responseText;
    	console.log(xhro);
    	  
        if (($("#newpass").val()!=="")&&($("#newpass2").val()!=="")){
                if ($("#newpass").val() == $("#newpass2").val()){
    					if(b != "CHANGED"){
    						alert("Pasahitz berria ez da onartzen.");
    						return false;
    					}
    					alert("Pasahitza aldatu da.")
    					return true;
    			}else{
                alert("Pasahitzak ez dira berdinak.");
                return false;
    			}
        }else {
            alert("Bete beharreko guztia bete mesedez.");
            return false;
    	}
    });
</script>
	
	
</body>
</html>

