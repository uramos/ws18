<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	

</head>
	
<?php 
				if(isset($_SESSION['user'])){
					echo "ZERBITZU HONETARAKO BAIMENIK EZ";
					return false;
				}			
			
?>

<body>
    <center>
        <h2> Sartu zure erabiltzaile posta</h2>
        		
        Email: <input type="email" id="posta" name="posta"  value="" size="30"/><p>
        <input type="button" class="recov" value="Lortu pasahitz berria"/>	<p> 
        
        <span id="done"></span>
        
    </center>
    
    <?php
    if(!isset($_SESSION['user']))
    echo "<p> <a href='layout.php'>Atzera</a>";
    ?>

	
	
<script>
    var xhro = new XMLHttpRequest();
	
    $(document).on('click', '.recov', function (event) {
        
        var id = document.getElementById("posta").value;
        if(id!=""){
          
            
    		xhro.open("POST","pasahitzaBerreskuratu.php", true);
        	xhro.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhro.send("id="+id);
    
    	 
    		
            	
        }
    });
    
    
    
    xhro.onreadystatechange = function(){
                    console.log(xhro.readyState);
                	 
                    if(xhro.readyState==4 && xhro.status == 200){
                        console.log(xhro.responseText);
                        if(xhro.responseText=="SENT"){
                            document.getElementById("done").innerHTML="Pasahitz berria zure postara bidali da.";
                            $('#done').css('color', 'green');
                            document.getElementById("posta").value ="";
                        }else if(xhro.responseText=="NOTINDB"){
                             document.getElementById("done").innerHTML="Posta hori erabiltzen duen erabiltzailerik ez dago.";
                            $('#done').css('color', 'orange');
                        }else{
                             document.getElementById("done").innerHTML="Errorerenbat gertatu da, zihurta zaitez posta ondo idatzi duzula eta saiatu berriro.";
                                $('#done').css('color', 'red');
                        }
            	      
    	        	}
    	        	  
            }
</script>
	
	
</body>
</html>

