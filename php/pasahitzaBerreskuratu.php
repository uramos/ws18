<?php
include 'dbConfig.php';


    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    
    $from = "aprobatu@mesedez.com";
    
   
    if(isset($_POST['id'])){
        
        
        
        $posta = $_POST['id'];
        if($posta!="admin000@ehu.eus"){
             
            
            $link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
            	
            		if ($link->connect_error) {
            			die("Connection failed: " . $link->connect_error);}
            		
            		
            		$sqls = ("select * from erabiltzaile where ePosta ='$posta'");
            	
            		
            		$ema = mysqli_query($link,$sqls);
            		
            		$rows_cnt = $ema->num_rows;
            		if($rows_cnt==1){
            		    
                		$newpass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                		
                		$passHash = password_hash($newpass, PASSWORD_BCRYPT);
            
                        $sqlu = ("update erabiltzaile set Pass = '$passHash' where ePosta ='$posta'");
                	
                		$emau = mysqli_query($link,$sqlu);
                		
                        
                        $to = "$posta";
                        
                        $subject = "Password Recovery";
                        
                        
                        $message = "Ez erantzun mezu honi. <br><br><br> Pasahitz berria:   <b>". $newpass."</b>";
                        $headers = "From: WS 21 Taldea <" . $from . ">\r\n";
                        
                        $headers  .= 'MIME-Version: 1.0' . "\r\n"; 
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                        
                        
                        //$mailheaders .= "Return-path: $from \r\n"; 
                        //$headers .= "X-Priority: 1 \r\n";  
                        //$headers .= "X-MSMail-Priority: Low \r\n";  
                        $headers .= "X-Mailer: PHP/".phpversion()." \n"; 
                        
                        
                        mail($to,$subject,$message, $headers);
                        echo "SENT";
                        return true;
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