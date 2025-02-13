<?php 
session_start();
include "data.php";
require 'fonction.php';
include "header.php";

//récuperation de l'id user connecté
$id_user =$_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

    $action = $_POST['action'];

    //si user n'est pas connecté renvoyer sur la page de connexion
    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {

    
        header('Location: index.php');  // Rediriger vers la page de connexion
        exit;  // Arrêter l'exécution des scripts suivants
    } 
    
$successmessage = "";
$errormessage = "";

}
//requete jointure des tables produits, paniers et utilisateurs pour afficher les informations necessaires

$querypanier  = $data->prepare("SELECT * FROM produits INNER JOIN  paniers ON produits.id = paniers.produit_id INNER JOIN utilisateurs ON utilisateurs.id = paniers.utilisateur_id WHERE utilisateur_id = :id ");

$querypanier->bindParam(':id', $id_user);

$querypanier->execute();

$panier = $querypanier->fetchAll();

?>

<div class="conte">
<?php
if ($panier) {

    
    foreach ($panier as $paniers) {  ?>

        <div class="contener">
        
     <img src=" <?= $paniers['image'] ?>" alt="">
      
    <?php
    //recuperation de l'id produit
    $id_produit = $paniers['produit_id'];

        echo  $paniers['nom_produit'] ; 
        echo  $paniers['description'] ;
?>
     
<form action="" method="POST">
    <input type="hidden" name="action" value="modifier">
    <input type="hidden" name="produit_id" value="<?php echo $paniers['produit_id']; ?>">
    <input type="number" name="quantite" value="<?php echo $paniers['quantite_panier']; ?>" min="1">
    <button type="submit">Mettre à jour</button>
</form>

<form action="" method="POST">
    <input type="hidden" name="action" value="supprimer">
    <input type="hidden" name="produit_id" value="<?php echo $paniers['produit_id']; ?>">
    <button type="submit">Supprimer</button>
</form>

<form action="" method="POST">
    <input type="hidden" name="action" value="vider">
    <button type="submit">Vider le panier</button>
</form>

<form action="" method="POST">
    <input type="hidden" name="action" value="payer">
    <input type="hidden" name="produit_id" value="<?php echo $paniers['produit_id']; ?>">
    <button type="submit">Acheter maintenant</button>
</form>

        </div>

   <?php }?>

        </div>

<?php } else {
    echo "le panier est vide.";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="js/panier.js"></script>
    <link href="css/panier.css" rel="stylesheet">
</head>
<body>

</body>
</html>

<?php

$id_user = $_SESSION['id_user']; // Récupération de l’ID utilisateur

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    //verifier si l'user est connecté
    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {

    
        header('Location: index.php');  // Rediriger vers la page de connexion
        exit;  // Arrêter l'exécution des scripts suivants
    } 

   //si user clique sur le bouton payer alors on declenche l'operation de paiement  
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
     $idCommande  = generateUniqueIdCommande();
     //recuperation des infos important dans la bdd    
    $quantite = $paniers['quantite_produit'];
    $prix = $results['prix'];
    $quantiteCommande  = $paniers['quantite_panier'] ;
    $id_vendeur = $paniers['id_user'];
    $idUser = $paniers['utilisateur_id'];
    $idEtat = 1;
    $idProduit = $paniers['produit_id'];
       
    if(is_numeric($quantiteCommande) && $quantiteCommande > 0 && $quantite > $quantiteCommande){
    
        //Calcul et stockage de la nouvelle quantité dans bdd
            
        $newQuantite = $quantite - $quantiteCommande ;
        
        //calcul du prix total selon la quantité commandé
        
        $totalPrix = $prix * $quantiteCommande ;
        
    if($newQuantite >= 0){  
            //requete pour modifier la quantité du produit dans la bdd     
    
        $query = $data->prepare( "UPDATE produits SET quantite_produit = :quantite WHERE id = :id");
        $query->bindParam(':quantite', $newQuantite);
        $query->bindParam(':id', $produit_id);
        
        $query->execute();
        
        
         // Insertion  des données recuperées et saisies par l'user dans la table commandes
        
        $querycommande = $GLOBALS['data']->prepare("INSERT INTO commandes (id_commande, utilisateur_id, produit_id, quantite_commande, etat_id, prix_commande) VALUES (:idCommande, :id_user, :id_produit, :com, :idEtat, :prix_commande)");
        $querycommande->bindParam(':idCommande', $idCommande);
        $querycommande->bindParam(':id_user', $idUser);
        $querycommande->bindParam(':id_produit', $idProduit);
        $querycommande->bindParam(':com', $quantiteCommande);
        $querycommande->bindParam(':idEtat', $idEtat);
        $querycommande->bindParam(':prix_commande', $totalPrix);
       
        
        $querycommande->execute(); 
    
        if($querycommande){
  //creation et sauvegarde d'une notification dans la bdd pour le vendeur  
            $message = "Nouvellecommande effectuée  pour le produit : " . $results['nom_produit'];

            $querynotification = $data->prepare("INSERT INTO notifications (vendeur_id, acheteur_id, produit_id, message) VALUES(:id_vendeur, :id_acheteur, :id_produit, :message)");
    
            $querynotification->bindParam(':id_vendeur', $id_vendeur);
            $querynotification->bindParam(':id_acheteur', $id_user);
            $querynotification->bindParam(':id_produit', $produit_id);        
            $querynotification->bindParam(':message', $message);
    
            $querynotification->execute();


            $querysupprimer = $data->prepare("DELETE FROM paniers WHERE produit_id = :produit_id AND utilisateur_id = :id_user");
        
            $querysupprimer->bindParam(':produit_id', $produit_id);
            $querysupprimer->bindParam(':id_user', $id_user);
    
    
            $querysupprimer->execute();
        }
               
        $successmessage = "Votre commande est en cours ";
        
        } else {
            $errormessage = "Quantité insuffisante";
        }
        }else{
        
        $errormessage = "TA SAISI N'EST PAS UN CHIFFRE";
        }
        
        }
 //si user clique sur modifier on modifie la quantite dans le panier   

    elseif ($action == "modifier" && isset($_POST['produit_id'], $_POST['quantite_panier'])) {
        // Modifier la quantité d’un produit
        $produit_id = $_POST['produit_id'];
        $quantite_panier = $_POST['quantite_panier'];

        if (is_numeric($quantite_panier) && $quantite_panier > 0) {
            $querymodifier = $data->prepare("UPDATE paniers SET quantite_panier = :quantite WHERE produit_id = :produit_id  AND utilisateur_id = :id_user");
           
            $querymodifier->bindParam(':quantite', $quantite_panier);
            $querymodifier->bindParam(':produit_id', $produit_id);
            $querymodifier->bindParam(':id_user', $id_user);

            $querymodifier->execute();
        }
    } 
    //si user clique sur supprimer on supprime le produit dans le panier
    elseif ($action == "supprimer" && isset($_POST['produit_id'])) {
        // Supprimer un produit du panier
        $produit_id = $_POST['produit_id'];
        $querysupprimer = $data->prepare("DELETE FROM paniers WHERE produit_id = :produit_id AND utilisateur_id = :id_user");
        
        $querysupprimer->bindParam(':produit_id', $produit_id);
        $querysupprimer->bindParam(':id_user', $id_user);


        $querysupprimer->execute();
    } 
//si user clique sur vider on vide (supprime) tous les produits du panier
    elseif ($action == "vider") {
        // Vider tout le panier
        $queryvider = $data->prepare("DELETE FROM paniers WHERE utilisateur_id = :id_user");
        $queryvider->bindParam(':id_user', $id_user);

        $queryvider->execute();
         }
}

?>