<?php

$lokal=1; // hodeian 0, lokalean gauedenean 1


if ($lokal){
   $zerbitzaria="localhost";
   $erabiltzailea="root";   // lokalean erabiltzailea root izan ohi da
   $gakoa="";               // eta ez da pasahitzarik jartzen
   $db="quiz";
} else{
   $zerbitzaria="localhost";
   $erabiltzailea="id7195700_urafe";
   $gakoa="contraseña";  // GitHub-en eremu hau EZABATU
   $db="id7195700_quiz";        // hodeiko db izena: hodeiko aurrizkia + zuek adierazitako db izena atzizki moduan
} 
?>