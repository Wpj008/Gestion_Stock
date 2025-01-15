<?php 
session_start();
include "data.php";
include "header.php";
require 'fonction.php';

$successmessage = "";
$errormessage = "";

    //recuperr l'id passé en parametre 
    $idProduit = $_GET['id_produit'];
       
   $id_user = $_SESSION['id_user'];
    
    $idEtat = 1 ;
    
    

    
    //requete pour recupèrer tous les infos du produit dont id == id passé en url

    $query = $data->prepare("SELECT * FROM produits WHERE  id = :id" );

    $query->bindParam(':id', $idProduit);
    $query->execute();
    $results = $query->fetch();

    //génération d'un ID unique en appellant la fonction...

 $nameproduit = $results['nom_produit'];
$idCom = generateUniqueIdCommande($nameproduit);
$idCommande = $idCom;


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

    //on recupère l'id user et on le stock dans une variable

    $idUser = $_SESSION['id_user'] ;

    // Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {

    
    header('Location: index.php');  // Rediriger vers la page de connexion
    exit;  // Arrêter l'exécution des scripts suivants
} 

//Recuperation des informations du produit ayant l'id passé en parametre

$_SESSION['id_produit'] = $_GET['id_produit'];
$quantite = $results['quantite'];
$prix = $results['prix'];
$com  = $_POST['com'] ;


//Redirection à la page commande.php

   // header('Location: commande.php');
   
if(is_numeric($com) && $com > 0){

    //Calcul et stockage de la nouvelle quantité dans bdd
    
    
    
    $newQuantite = $quantite - $com ;
    
    //calcul du prix total selon la quantité commandé
    
    $totalPrix = $prix * $com ;
    
    if($newQuantite >= 0){

        //requete pour modifier la quantité du produit dans la bdd     

    $query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
    $query->bindParam(':quantite', $newQuantite);
    $query->bindParam(':id', $idProduit);
    
    $query->execute();
    
    
     // Insertion  des données recuperées et saisies par l'user dans la table commandes
    
    $querycommande = $GLOBALS['data']->prepare("INSERT INTO commandes (id_commande, utilisateur_id, produit_id, quantite, etat_id, prix_commande) VALUES (:idCommande, :id_user, :id_produit, :com, :idEtat, :prix_commande)");
    $querycommande->bindParam(':idCommande', $idCommande);
    $querycommande->bindParam(':id_user', $idUser);
    $querycommande->bindParam(':id_produit', $idProduit);
    $querycommande->bindParam(':com', $com);
    $querycommande->bindParam(':idEtat', $idEtat);
    $querycommande->bindParam(':prix_commande', $totalPrix);
   
    
    $querycommande->execute(); 
       
    
    $successmessage = "Votre commande est en cours ";
    
    echo "</div>";
    } else {
        $errormessage = "Quantité insuffisante";
    }
    }else{
    
    $errormessage = "TA SAISI N'EST PAS UN CHIFFRE";
    }
    
    }


  
  echo $id_user;
  
  echo  $idProduit;
  
  if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {
  
      $panier_query = $GLOBALS['data']->prepare("INSERT INTO paniers (utilisateur_id, produit_id) VALUES (:id_user, :id_produit)");
          
          $panier_query->bindParam(':id_user', $id_user);
          $panier_query->bindParam(':id_produit', $idProduit);
      
          $panier_query->execute();
      
      
      
      }  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link href="css/produit.css" rel="stylesheet">
    <link href="css/accueil.css" rel="stylesheet">
    <script src="js/verification.js" defer></script>
    
</head>
<body>

<div class="cart-item">
  
    <img src="<?= $results['image'] ?>" alt="télévision 55'LG">
    <div class="cart-actions">
    <div class="cart-info">
        <h4> : <?= $results['nom_produit'] ?> ; <?= $results['description'] ?></h4>
        <p> Prix Unitaire : <?= $results['prix'] . " $"?> </p>
        
    </div>
    
    <form method="POST" action="" onsubmit="return commandeChamps();">

    <select name="com" id="com">
                                <option value="1"selected>1</option>
                            <option value="2" >2</option>
                        <option value="3" >3</option>
                    <option value="4" >4</option>
                        <option value="5" >5</option>
                           <option value="6" >6</option>
     </select>

    
    </div>
<div class="container">

<p id="successmessage" style="color: green;"><?= $successmessage; ?></p>

<p id="errormessage" style="color: red;"><?= $errormessage; ?></p>

<button type="submit" name="submit" >Commander</button>
<form method="POST" action="">
              <button  type="submit" name="submit">🛒</button>
              </form>
       

</form>
         </div>
    </div>

</body>
</html>

<?php
include "footer.php";
?>
      