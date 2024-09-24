<?php 
session_start();
include "data.php";
include "header.php";

$successmessage = "";
$errormessage = "";

    //recuperr l'id passé en parametre 
    $idProduit = $_GET['id_produit'];
    $idUser = $_SESSION['id_user'] ;
    $idEtat = 1 ;
    

    

    $query = $data->prepare("SELECT * FROM produits WHERE  id = :id" );

    $query->bindParam(':id', $idProduit);
    $query->execute();
    $results = $query->fetch();


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//Recuperation des informations du produit ayant l'id passé en parametre

$_SESSION['id_produit'] = $_GET['id_produit'];
$quantite = $results['quantite'];
$prix = $results['prix'];
$commandes  = $_POST['commandes'] ;

//Redirection à la page commande.php

   // header('Location: commande.php');
   
if(is_numeric($commandes) && $commandes > 0){

    //Calcul et stockage de la nouvelle quantité dans bdd
    
    
    
    $newQuantite = $quantite - $commandes ;
    
    //calcul du prix total selon la quantité commandé
    
    $totalPrix = $prix * $commandes ;
    
    if($newQuantite >= 0){
    
    $query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
    $query->bindParam(':quantite', $newQuantite);
    $query->bindParam(':id', $idProduit);
    
    $query->execute();
    
    
     // Insertion dans la table commandes  des données recuperées 
    
    $querycommande = $GLOBALS['data']->prepare("INSERT INTO commandes (utilisateur_id, produit_id, quantite, etat_id, prix_commande) VALUES (:id_user, :id_produit, :commandes, :id, :prix_commande)");
    $querycommande->bindParam(':id_user', $idUser);
    $querycommande->bindParam(':id_produit', $idProduit);
    $querycommande->bindParam(':commandes', $commandes);
    $querycommande->bindParam(':prix_commande', $totalPrix);
    $querycommande->bindParam(':id', $idEtat);
    
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
        <h4> : <?= $results['nom'] ?> ; <?= $results['description'] ?></h4>
        <p> Prix Unitaire : <?= $results['prix'] . " $"?> </p>
        
    </div>
    
    <form method="POST" action="" onsubmit="return commandeChamps();">

    <select name="commandes" id="commandes">
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
       

</form>
         </div>
    </div>

</body>
</html>

<?php
include "footer.php";
?>
      