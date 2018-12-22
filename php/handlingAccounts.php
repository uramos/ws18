<?php 

session_start();

if(empty($_SESSION['sessionmode']) || $_SESSION['sessionmode'] == 'user'){
	echo "ZERBITZU HONETARAKO BAIMENIK EZ!";
	return false;
}

include 'dbConfig.php';

$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
if($link->connect_error){
	die("Connection failed" . $link->connect_error);
}

$sql = "select * from erabiltzaile";

$ema = mysqli_query($link, $sql);
?>
<head>
<style type="text/css">
#main-header {
	background: #333;
	color: white;
	height: 40px;
	
	width: 100%; 
	left: 0; 
	top: 0; 
	position: fixed; 
}
</style>
</head>
<?php
echo '<body style="margin-top:50px">';
echo "<header id='main-header' >";
echo "<a href=layoutLogeatua.php style='color:white' >Atzera</a>";
echo "</header>";
echo '<table border=1> <tr> <th> EPOSTA </th> <th> DEITURA </th> <th> PASAHITZA </th> <th> ARGAZKIA </th> <th> BLOKEATUA </th> <th> ALDATU EGOERA </th> <th> EZABATU KONTUA </th> </tr>';

while($row = mysqli_fetch_array($ema, MYSQLI_ASSOC)){
    
	$posta = $row["ePosta"];
	if($posta!='admin000@ehu.eus'){
    	$irudi = '<img width=200px src= "data:image/*;base64,' . base64_encode( $row['Argazkia'] ) . '" />';
    
    	echo '<tr> <td> ' . $row["ePosta"] . ' </td> <td> ' . $row["Deitura"] . ' </td> <td> ' . $row["Pass"] . ' </td> <td> ' . $irudi . ' </td> <td> <span id="'.$posta.'" >' . $row["Blokeatuta"] . '</span> </td> <td> <input type=button name="Aldatu Egoera" value="Aldatu egoera" onclick=blokalda("'. $posta. '"); /> </td> <td> <input type=button class="delete" id="'. $posta. '" name="Ezabatu Erabiltzailea" value="Ezabatu Erabiltzailea"/> </td></tr>';

	    
	}
}

echo '</table>';
//echo '</body>';

mysqli_free_result($ema);
mysqli_close($link);

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>	

	var xhro2 = new XMLHttpRequest();
		
	
	function blokalda(id){
		
		xhro2.open("GET","aldatuEgoera.php?id="+id, true);
		
		xhro2.send();
		console.log(xhro2);
		
		
		xhro2.onreadystatechange = function(){
        console.log(xhro2.readyState);
        
            if(xhro2.readyState==4 && xhro2.status == 200){
                console.log("ema");
                //console.log(xhro2.responseText);
                document.getElementById(id).innerHTML=xhro2.responseText;
            }
        }
		
	}


</script>

<script >
	var xhro = new XMLHttpRequest();
	
	
    $(document).on('click', '.delete', function (event) {
        
        console.log(this.id);
        
        var r=confirm(this.id+": erabiltzailea borratu nahi duzu?");
        if (r==true)
        {
            var borratu = true;
            alert(this.id+": Ezabatuta");
        }
        else
        {
            var borratu = false;
        }
	
	    if(this.id!="admin000@ehu.eus" && borratu){
		xhro.open("GET","ezabatuErabiltzaile.php?id="+this.id, true);
		
		xhro.send();
		console.log(xhro);
		
		
		xhro.onreadystatechange = function(){
            console.log(xhro.readyState);
                if(xhro.readyState==4 && xhro.status == 200){
                    console.log(xhro.responseText);
	        	}
	        	  
        }    
	
	

		event.preventDefault();
        $(this).closest('tr').remove();
	    }else if(this.id!="admin000@ehu.eus" && !borratu){
	        alert("Ez da erabiltzailea ezabatu.");
	    }else{
	         alert(this.id+": Ezin da ezabatu administratzaile kontua");
	    }
	        
	    
    });
</script>

</body>



