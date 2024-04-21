<?php



//FONCTION AJOUT NOM PRODUIT


function name($text ='Veuillez saisir les informations du produit : '. '<br>'){
        
    echo $text ;
    
    $nom = readline('Nom du produit : ');
    
    
    return [$nom];
}

$nom_produit = name();

//var_dump($nom_produit);



?>