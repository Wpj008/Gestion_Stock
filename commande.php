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

    // Insertion dans la table commandes  des données recuperées 

    $query = $GLOBALS['data']->prepare("INSERT INTO commandes (utilisateur_id, produit_id, quantite, etat_id) VALUES (:id_user, :id_produit, :commande, :id)");
    $query->bindParam(':id_user', $idUser);
    $query->bindParam(':id_produit', $idProduit);
    $query->bindParam(':commande', $commande);
    $query->bindParam(':id', $idEtat);

    $query->execute(); 


// calcul de la nouvelle quantité du stock dans la bdd apres commande

    $newQuantite = $quantite - $commande ;

// calcul du prix total de la commande

   // $totalPrix = $prix * $commande;




// Remplassement de la nouvelle quantite apres commande dans la bdd

    if($newQuantite > 0){

    $query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
    $query->bindParam(':quantite', $newQuantite);
    $query->bindParam(':id', $idProduit);

    $query->execute();

    
        
    echo "Votre commande est en cours"."<br>";
   /*
   echo "quantité commandé : ".$commande."<br>";
    echo "Prix total : ". $totalPrix."$"."<br>"; 
*/
   

    }else{

        echo "Quantité insuffisante";
    }
}

    
    ?>
    
    <br><br><br><br><br>


    <form method="POST" action="">

    <label for="commande">Quelle quantité desirez-vous ?</label><br><br>
    <input id="commande" name="commande" type="text"><br><br><br><br>

    <button type="submit" name="submit">Passer la commande</button>

    </form>
