<?php

//FONCTION QUANTITE PRODUIT

function quantite($text = 'Quelle quantité désirez vous stocker ? : '){
    
    echo '</br>';
    
    echo $text;
    $taille = (int)readline();

     echo 'Quel est le prix du produit en $ ? : ';
    $prix = (int)readline();
   
    
    return [$taille, $prix];
}
$dimension = quantite();



?>
