<?php
session_start();

include 'dbConfig.php';

    if(isset($_SESSION['user'])&&isset($_POST['oldpass']) && isset($_POST['newpass1']) && isset($_POST['newpass2'])){
        
        if($_POST['newpass1']!=$_POST['newpass2']){
            echo "NOTSAMEPASS";
            return true;
        }
        
        
        
         $posta =$_SESSION['user'];
         
         if($posta!="admin000@ehu.eus"){
             
            
            $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
            	
            		if ($link->connect_error) {
            			die("Connection failed: " . $link->connect_error);}
            		
            		
            		$sqls = ("select * from erabiltzaile where ePosta ='$posta'");
            	
            		
            		$ema = mysqli_query($link,$sqls);
            		
            		$rows_cnt = $ema->num_rows;
            		if($rows_cnt==1){
            		 $row = mysqli_fetch_array($ema,MYSQLI_ASSOC);
            	
            		 if(password_verify($_POST['oldpass'],$row['Pass'])){
            		     
                		if($_POST['newpass1']==$_POST['oldpass']){
                            echo "NEWASOLD";
                            return true;
                        }
                		     	
                		$new=$_POST['newpass1'];
                		 $passHash = password_hash($new, PASSWORD_BCRYPT);
                		
                		$sqlu = ("update erabiltzaile set Pass='$passHash' where ePosta = '$posta'");
                	    
            	
                		$emau = mysqli_query($link,$sqlu);
                		
                	    echo "CHANGED";
            		     return true;
            		     
            		     
            		 }else{
            		     echo "BADPASS";
            		        return true;
            		 }
            		 
            		 
            		}else{
            		    echo "NOTINDB";
            		    return true;
            		}
         }else{
             echo "ADMIN";
             return true;
         }
    }
    echo "NOTSET";
?>