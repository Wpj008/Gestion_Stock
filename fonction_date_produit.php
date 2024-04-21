<?php

//FONCTION DATE FAB-EXP :

function date_produit($text = 'Veuillez saisir les dates : '){
    
    echo $text;
    
    while(true){
    $date_fabrication = (int)readline('Date de Fabrication : ');
    if($date_fabrication >= 2018 && $date_fabrication <= 2024){
        
        break;
    }
    
    }
    
    while(true){
    $date_expiration = (int)readline('Date d expiration : ');
    if($date_expiration >= 2018 && $date_expiration <= 2050 && $date_expiration > $date_fabrication){
        break;
    }
    
    }
    
    return [$date_fabrication, $date_expiration];
}


$time = date_produit();

//var_dump ($time);


?>