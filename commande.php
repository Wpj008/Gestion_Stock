<?php 
session_start();
include "data.php";
include "header.php";


//recuperation de l'id utilisateur ; id etat commande ; id du produit ; la quantite en stock

        $idUser = $_SESSION['id_user'] ;
        $idEtat = 1 ;
        $idProduit = $_SESSION['id_produit'];
        $quantite =  $_SESSION['quantite'];
       



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

    //recuperation de la quantite voulu par l'user ; recuperation du prix d'un produit 

    $commande = $_POST['commande'];
    $prix = $_SESSION['prix'];

   


//Calcul et stockage de la nouvelle quantité dans bdd

      $newQuantite = $quantite - $commande ;
      
      //calcul du prix total selon la quantité commandé

      $totalPrix = $prix * $commande ;
    
        if($newQuantite > 0){
    
        $query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
        $query->bindParam(':quantite', $newQuantite);
        $query->bindParam(':id', $idProduit);
    
        $query->execute();


         // Insertion dans la table commandes  des données recuperées 

    $querycommande = $GLOBALS['data']->prepare("INSERT INTO commandes (utilisateur_id, produit_id, quantite, etat_id, prix_commande) VALUES (:id_user, :id_produit, :commande, :id, :prix_commande)");
    $querycommande->bindParam(':id_user', $idUser);
    $querycommande->bindParam(':id_produit', $idProduit);
    $querycommande->bindParam(':commande', $commande);
    $querycommande->bindParam(':prix_commande', $totalPrix);
    $querycommande->bindParam(':id', $idEtat);

    $querycommande->execute(); 


        


        echo "<div class='confirmation-message'>Votre commande est en cours.<br>";
       
        echo "</div>";
    } else {
        echo "<div class='error-message'>Quantité insuffisante</div>";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/commande.css">
</head>
<body>


<form method="POST" action="">
    <label for="commande">Quelle quantité désirez-vous ?</label><br><br>
    <input id="commande" name="commande" type="text" required><br><br><br><br>
    <button type="submit" name="submit">Passer la commande</button>
</form>

</body>
</html>


<?php
include "footer.php";
?>