<?php session_start();?>
<html>
    <head>
        
        <style>
        
            table {
              border-collapse: collapse;
            }
            td, th {
              border: 1px solid #ddd;
              padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2;}
            
            tr:hover {background-color: #1dd;}
            
            th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #4CAF50;
              color: white;
            }
            tr:first-child {
              border-top: none;
            }
        </style>
        
    </head>
    
    
<?php 
				if(empty($_SESSION['sessionmode'])){
					echo "ZERBITZU HONETARAKO BAIMENIK EZ";
					return false;
				}		
			
?>
    
    
    <body style="margin-top:50px" onload="return kargatuGaldera()"> <!--onload="return kargatu()"-->
        
        <center>
            
            <section>
                Zure Puntuazioa: 
                <span id='unekoscore'><?php echo $_SESSION['score']?></span>
            </section>
            <section>
                Zure Puntuazio Maximoa: 
                <span id='maxscore'><?php echo $_SESSION['maxscore']?></span>
            </section>
            <section>
                <span id='unekogaldera'  style="display:none"><?php echo $_SESSION['galderaID']?></span>
            </section>
            
            <!--<section>
                
                <span><b>Gaia</b></span>
                <select class='gai' id="gai"></select>
                
                <span><b>-</b></span>
                <select clas='zail' id="zail">
                   <option value="1">1</option> 
                   <option value="2">2</option> 
                   <option value="3">3</option>
                   <option value="4">4</option> 
                   <option value="5">5</option>
                </select>
                <span><b>Zailtasuna</b></span>
            </section>-->
            <br>
            
            <br>
            <br>
            <table id="galdTaula" >
            		<tr><th>Hemen agertuko dira galderak:</th></tr>
            </table>
            <br>
            <br>
            
            <section>
                <span>Zure gustokoa izan da galdera hau?</span>
                <input type=radio name="balora" value="Bai">Bai</input>
                <input type=radio name="balora" value="Ez">Ez</input>
                <input type=radio name="balora" value="NA" checked>N/A</input>
            </section>
            
            <br>
            <section>
                <!--<input type=button class="galdBerri" id="galdBerri" value="Galdera berri bat">-->
                <input type=button class="erantzun" value="Bidali Erantzuna">
            </section>
            
        </center>
        
        
        
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     
        
     
        <script>
            
             //var xhroKargaGai = new XMLHttpRequest();
            
            //function kargatu(){
              //  	xhroKargaGai.open("GET","kargatuGalderaFiltroak.php", true);
    	        //    xhroKargaGai.send();
    	           
          //  }
            
            
           // xhroKargaGai.onreadystatechange = function(){
            //console.log(xhroKargaGai.readyState);
            
              //  if(xhroKargaGai.readyState==4 && xhroKargaGai.status == 200){
                   
                //    document.getElementById('gai').innerHTML="<optgroup label='Aukeragaiak'>"+xhroKargaGai.responseText+"</optgroup><optgroup label='Edozein Gai'> <option value='Edozein'>Edozein</option></optgroup>";
               // }
            //}
       
        
        var xhroKarGal = new XMLHttpRequest();
        
    	//$(document).on('click', '.galdBerri', function (event) {
          //  kargatuGaldera();
    	//});
		
		
		
		
		//bidali erantzuna
		
		var xhera = new XMLHttpRequest();
		
		$(document).on('click', '.erantzun', function (event) {
		    
             xhera.open("POST","erantzunGaldera.php",true);
   		     xhera.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
   		     
   		     
   		     var auk = getRadioButtonSelectedValue(document.getElementsByName("aukera"));
   		     console.log("aukera:  "+auk);
   		     var bal = getRadioButtonSelectedValue(document.getElementsByName("balora"));
   		     console.log("balorazioa:  "+bal);
   		     var gald=document.getElementById("galdera").innerHTML;
   		     console.log("galdera:  "+gald);
   		     
	         xhera.send("sarGaldera="+gald+"&sarZuzena="+auk+"&balorazioa="+bal);
	         
    	});
		
			xhera.onreadystatechange = function(){
            console.log(xhera.readyState);
            
                if(xhera.readyState==4 && xhera.status == 200){
                    
                    document.getElementById("unekoscore").innerHTML=' <?php echo $_SESSION['score'] ?> ';
                    window.location.assign("quizz.php");
                    console.log(xhera.responseText);
                }
			}
		
		function getRadioButtonSelectedValue(ctrl)
        {
            for(i=0;i<ctrl.length;i++)
                if(ctrl[i].checked) return ctrl[i].value;
        }
		
		
		
		function kargatuGaldera(){
		        	    //var zailtasuna = document.getElementById('zail').value;
    		xhroKarGal.open("GET","kargatuQuizzGalderak.php", true);
    	    xhroKarGal.send();
    		return true;
		}
		
		var i = 0;
		
		xhroKarGal.onreadystatechange = function(){
            console.log(xhroKarGal.readyState);
            
                if(xhroKarGal.readyState==4 && xhroKarGal.status == 200){
                   
                    	var table="<tr><th>Galdera zenbakia</th><th>Egilea</th><th>Galdera</th><th>Aukera1</th><th>Aukera2</th><th>Aukera3</th><th>Aukera4</th><th>Zailtasuna</th><th>Gaia</th><th>Irudia</th></tr>";
    			
			            var str = xhroKarGal.responseText;
			            
			            //console.log(str);
			            
			            var gald = str.split('</tr>');
			            
			            //console.log(gald);
			            
			            var currentRow=$(str).closest("tr");
			            
			            var kopurua = (gald.length);
			            
			            //var aukeratua = Math.floor((Math.random() * kopurua));

                        document.getElementById("unekogaldera").innerHTML='<?php echo $_SESSION['galderaID']?>';

	                    var galdera = gald["<?php echo $_SESSION['galderaID'] ?>"].split('</td>');
	                    
	                    //console.log(galdera);
	                    
	                    
	                    if("<?php echo $_SESSION['galderaID'] ?>"==(kopurua-1)){
	                        window.location.assign("Amaiera.php");
	                    }
				
						var random = Math.floor(Math.random()*(6-3+1)+3);
						var random1 = 0;
						var random2 = 0;
						var random3 = 0;
						
						if(random==3){
						    random3 = 6;
						    random2 = Math.floor(Math.random()*(5-4+1)+4);
						    if(random2==4){
						        random1=5;
						    }else{
						        random1=4;
						    }
						}else if(random==6){
						    random3 = 3;
						    random2 = Math.floor(Math.random()*(5-4+1)+4);
						    if(random2==4){
						        random1=5;
						    }else{
						        random1=4;
						    }
						}else if(random==4){
						    random1=3;
						    random2=6;
						    random3=5;
						}else if(random==5){
						    random1=4;
						    random2=3;
						    random3=6;
						}
                            						
						
					    table += galdera[0]+galdera[1]+galdera[2]+galdera[random]+galdera[random1]+ galdera[random2]+galdera[random3]+galdera[7]+galdera[8]+ galdera[9];
			
		    	        document.getElementById("galdTaula").innerHTML = table;
			                
			           
			            //var r = currentRow[aukeratua].childNodes[2].textContent;
			            
			            //console.log(aukeratua);
			            
			            //console.log(currentRow[aukeratua].childNodes[4].textContent); //aukera1
			            //console.log(currentRow[aukeratua].childNodes[5].textContent); //aukera2
    		            //console.log(currentRow[aukeratua].childNodes[7].textContent); //aukera3
			            //console.log(currentRow[aukeratua].childNodes[9].textContent); //aukera4
			            
						//table += '<tr><td>''</td></tr>';
    			
                }
            }
		
	</script>
	
	<a href=layoutLogeatua.php style='color:black' >Atzera</a>

    </body>
</html>