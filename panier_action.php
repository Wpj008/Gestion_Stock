<?php
session_start();
include "data.php";
require 'fonction.php';

$successmessage = "";
$errormessage = "";



$id_user = $_SESSION['id_user']; // Récupération de l’ID utilisateur

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {

    
        header('Location: index.php');  // Rediriger vers la page de connexion
        exit;  // Arrêter l'exécution des scripts suivants
    } 

    
    if ($action == "payer"){

        //recuperr l'id passé en parametre 
        $produit_id = $_POST['produit_id'];
       
       $id_user = $_SESSION['id_user'];
        
        
        //requete pour recupèrer tous les infos du produit dont id == id passé en url
    
        $query = $data->prepare("SELECT * FROM produits WHERE  id = :id" );
    
        $query->bindParam(':id', $produit_id);
        $query->execute();
        $results = $query->fetch();
    
        //génération d'un ID unique en appellant la fonction...
    
     //$nameproduit = $results['nom_produit'];
     $idCommande  = generateUniqueIdCommande();
    
    
    $quantite = $results['quantite'];
    $prix = $results['prix'];
    $quantiteCommande  = $_POST['quantite'] ;
    
    var_dump($quantiteCommande);
    
    //Redirection à la page commande.php
    
       // header('Location: commande.php');
       
    if(is_numeric($quantiteCommande) && $quantiteCommande > 0){
    
        //Calcul et stockage de la nouvelle quantité dans bdd
        
        
        
        $newQuantite = $quantite - $quantiteCommande ;
        
        //calcul du prix total selon la quantité commandé
        
        $totalPrix = $prix * $quantiteCommande ;
        
        if($newQuantite >= 0){
    
            //requete pour modifier la quantité du produit dans la bdd     
    
        $query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
        $query->bindParam(':quantite', $newQuantite);
        $query->bindParam(':id', $produit_id);
        
        $query->execute();
        
        
         // Insertion  des données recuperées et saisies par l'user dans la table commandes
        
        $querycommande = $GLOBALS['data']->prepare("INSERT INTO commandes (id_commande, utilisateur_id, produit_id, quantite, etat_id, prix_commande) VALUES (:idCommande, :id_user, :id_produit, :com, :idEtat, :prix_commande)");
        $querycommande->bindParam(':idCommande', $idCommande);
        $querycommande->bindParam(':id_user', $idUser);
        $querycommande->bindParam(':id_produit', $idProduit);
        $querycommande->bindParam(':com', $quantiteCommande);
        $querycommande->bindParam(':idEtat', $idEtat);
        $querycommande->bindParam(':prix_commande', $totalPrix);
       
        
        $querycommande->execute(); 
    
        if($querycommande){
    
            $message = "Nouvellecommande effectuée  pour le produit : " . $results['nom_produit'];
    
    
            $querynotification = $data->prepare("INSERT INTO notifications (vendeur_id, achteur_id, produit_id, message) VALUES(:id_vendeur, :id_acheteur, :id_produit, :message");
    
            $querynotification->bindParam(':id_vendeur', $id_vendeur);
            $querynotification->bindParam(':id_acheteur', $id_user);
            $querynotification->bindParam(':id_produit', $produit_id);        
            $querynotification->bindParam(':message', $message);
    
            $querynotification->execute();
    
        }
           
        
        $successmessage = "Votre commande est en cours ";
        
        echo "</div>";
        } else {
            $errormessage = "Quantité insuffisante";
        }
        }else{
        
        $errormessage = "TA SAISI N'EST PAS UN CHIFFRE";
        }
        
        }
    

    elseif ($action == "modifier" && isset($_POST['produit_id'], $_POST['quantite'])) {
        // Modifier la quantité d’un produit
        $produit_id = $_POST['produit_id'];
        $quantite = $_POST['quantite'];

        if (is_numeric($quantite) && $quantite > 0) {
            $querymodifier = $data->prepare("UPDATE paniers SET quantite = :quantite WHERE produit_id = :produit_id  AND utilisateur_id = :id_user");
           
            $querymodifier->bindParam(':quantite', $quantite);
            $querymodifier->bindParam(':produit_id', $produit_id);
            $querymodifier->bindParam(':id_user', $id_user);

            $querymodifier->execute();
        }
    } 
    elseif ($action == "supprimer" && isset($_POST['produit_id'])) {
        // Supprimer un produit du panier
        $produit_id = $_POST['produit_id'];
        $querysupprimer = $data->prepare("DELETE FROM paniers WHERE produit_id = :produit_id AND utilisateur_id = :id_user");
        
        $querysupprimer->bindParam(':produit_id', $produit_id);
        $querysupprimer->bindParam(':id_user', $id_user);


        $querysupprimer->execute();
    } 
    elseif ($action == "vider") {
        // Vider tout le panier
        $queryvider = $data->prepare("DELETE FROM paniers WHERE utilisateur_id = :id_user");
        $queryvider->bindParam(':id_user', $id_user);

        $queryvider->execute();
    }

  $successmessage = "Votre commande est en cours ";

    }


// Redirection vers le panier après chaque action
header("Location: panier.php");
exit();







?>