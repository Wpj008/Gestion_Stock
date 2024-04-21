<?php



include_once 'fonction.php';

var_dump(name());

include_once 'fonction_date_produit.php';

var_dump(date_produit());

include_once 'fonction_quantite_produit.php';

var_dump(quantite());

include_once 'fonction_retour_oui_non.php';


//FONCTION OUI NON


function retour_oui_non($text) {
    
    
    
        
        
    $reponse = (int)readline($text ) ;

    while($reponse !== 1 || $reponse !== 2){
     
     if ($reponse === 1) {
         $nomProduit = name();
         $dateProduit = date_produit();
         $quantiteProduit = quantite();
         
         
         echo "Produit  ajoué" ;
         
         
         
     } 
     
 
     
     elseif ($reponse === 2) {
         
         echo 'Merci et Au revoir' ;
         
     
     }

     
     $reponse++;
     
 }
}


$reponse = retour_oui_non('Voulez vous continuer ? : 1. oui  2. non : ');



var_dump($nom_produit);
var_dump ($time);
var_dump ($dimension);



?>