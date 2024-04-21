<?php 

/*
//FONCTION AJOUT NOM PRODUIT


function name($text ='Veuillez saisir les informations du produit : '. '<br>'){
        
    echo $text ;
    
    $nom = readline('Nom du produit : ');
    
    
    return [$nom];
}

$nom_produit = name();

//var_dump($nom_produit);

*/


////////////////////////////////////////////////////

/*


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

*/

/////////////////////////////////////////////////

/*

//FONCTION QUANTITE PRODUIT

function quantite($text = 'Quelle quantité désirez vous stocker ? : '){
    
    echo $text;
    $taille = (int)readline();

     echo 'Quel est le prix du produit en $ ? : ';
    $prix = (int)readline();
   
    
    return [$taille, $prix];
}
$dimension = quantite();


*/
//////////////////////////////////////////////////

//FONCTION OUI NON
/*

function retour_oui_non($text) {
    
    
    
        
        
       $reponse = (int)readline($text ) ;

       while($reponse !== 1 || $reponse !== 2){
        
        if ($reponse === 1) {
            $a = name();
            $b = date_produit();
            $c = quantite();
            
            
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




*/
////////////////////////////////////////////////////







$produit =

    [

        'PARACETAMOL' => [ 'Quantité' =>100,
                            'Date Fab-Exp' => '2021-2026',
                            'Prix' => 2..'$' ],
                
        
        'DOLIPRANE' => [ 'Quantité' =>150,
                            'Date Fab-Exp' => '2022-2027',
                            'Prix' => 3..'$' ],
                            
        'XALATAN' => [ 'Quantité' =>50,
                            'Date Fab-Exp' => '2021-2026',
                            'Prix' => 2..'$' ],
                            
        'MICROLAX' => [ 'Quantité' =>200,
                            'Date Fab-Exp' => '2023-2028',
                            'Prix' => 1..'$' ],
                            
        'CLAMOXYL' => [ 'Quantité' =>150,
                            'Date Fab-Exp' => '2022-2027',
                            'Prix' => 4..'$' ],

    ];

    function ajout(){

    foreach ($produit as $clef => $produits){

                echo 'Produits : ' .$clef;

    foreach($produits as $caracteristique => $valeur){

                    echo $caracteristique. ' : ' .$valeur;
                }
                
            }
        }
         
        $affichage = ajout();

        echo $produit;
//////////////////////////////////////
echo 'QUELLE OPERATION DESIREZ VOUS EFFECTUER ? '.'<br>';

echo '1. Consulter le stock'.'<br>';
echo '2. Ajouter un produit au stock'.'<br>';
echo '3.Supprimer un produit'.'<br>';

$retour = readline();
$menu = 1;

if($menu === 1){
    
     var_dump($produit);
}

else {
    echo 'erreur';
}                            
                            
                            
                            
                            



?>