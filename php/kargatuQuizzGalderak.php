<?php
include 'dbConfig.php';

//if(isset($_GET['gai']) && isset($_GET['zail'])){
     
        $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
            	
		if ($link->connect_error) {
			die("Connection failed: " . $link->connect_error);}
		
	
		//if($_GET['gai']!='Edozein' && $_GET['zail']!=0){
		    
    	//	$sqls = ("select * from questions where galderaGai='".$_GET['gai']."' and galderaZail='".$_GET['zail']."'");
		
		//}else if($_GET['gai']!='Edozein' && $_GET['zail']==0){
		    
    	//	$sqls = ("select * from questions where galderaGai='".$_GET['gai']."'");
		
		//}else if($_GET['gai']=='Edozein' && $_GET['zail']!=0){
		    
    	//	$sqls = ("select * from questions where galderaZail='".$_GET['zail']."'");
		
		//}else{
		    $sqls = ("select * from questions");
		//}
		
		$ema = mysqli_query($link,$sqls);
		//$kop = ("select count('id') from questions");
		//$kopuru = mysqli_query($link,$kop);
		
		//$rows_cnt = $ema->num_rows;
		$idGald = 0;
	
		while ($row = mysqli_fetch_array($ema,MYSQLI_ASSOC)) {
		    	
		    $irudi = '<img width=200px src="data:image/*;base64,'.base64_encode( $row['IrudiBin'] ).'"/>';
		    
			echo '<tr><td>'.$idGald.'</td><td>' . $row['eMail'] . '</td><td><span id="galdera" value="'. $row['sarGaldera'] . '">'. $row['sarGaldera'] . '</span> </td> <td> <input type="radio" name="aukera" value="' . $row['sarZuzena'].'">'.$row['sarZuzena'].'</input> </td><td> <input type="radio" name="aukera" value="' . $row['sarOkerra1'].'">'.$row['sarOkerra1'].'</input> </td> <td> <input type="radio" name="aukera" value="' . $row['sarOkerra2'].'">'.$row['sarOkerra2'].'</input> </td>	<td> <input type="radio" name="aukera" value="' . $row['sarOkerra3'].'">'.$row['sarOkerra3'].'</input> </td>';
			
			
			echo '<td>' . $row['galderaZail'] . '</td><td>' . $row['galderaGai'] . '</td><td>' . $irudi . '</td>';
			echo '</tr>';
			
			$idGald += 1;
			
		 }
//}
?>