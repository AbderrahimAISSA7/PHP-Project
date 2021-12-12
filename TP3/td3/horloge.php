<?php
  
  require("lib/ParmsException.class.php");

  require("lib/fonctions_parms.php");
  require("lib/fonctions_clock.php");
  
/**
 * IMPORTANT : 
 * Ce script n'est qu'une ébauche.
 * 
 * En l'état actuel son fonctionnement n'est pas satisfaisant
 *
 * 
 * Utiliser directement les variable du tableau $_GET peut être dangereux
 *
 * Ce script est à modifier et compléter au cours de l'exercice
 * 
 */

 
  try{
   // hours doit être un entier sans signe
   $hours = checkUnsignedInt("hours",0); //get : ramener la valeur $hours de l'URL de Site 
   
   // minutes doit être un entier sans signe
   $minutes = checkUnsignedInt("minutes",0);

   // seconds doit être un entier sans signe
   
   //$seconds = $_GET['seconds'];
    $seconds = checkUnsignedInt("seconds",0);

  //
    $hands = checkColor("hands","blue");

    $bg = checkColor("bg","transparent");

    $markers = checkColor("markers","grey");

      
   // calcul des angles des aiguilles
   $angles = angles($hours, $minutes, $seconds);
   
 
   // inclusion de la page template :
   require('views/page.php');

  } catch (ParmsException $e){
            include("views/pageErreur.html") ;     

  }
 

 
 
?>