<?php 
session_start();
include "data.php";
include "header.php";
require 'fonction.php';
$nom_user = $_SESSION['nom'];
$successmessage = "";
$errormessage = "";

    //recuperr l'id produit et celui de l'user passé en parametre 
    $idProduit = $_GET['id_produit'];
    $_SESSION['id_produit'] = $_GET['id_produit'];
   $id_user = $_SESSION['id_user'];

    $idEtat = 1 ;

    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {

    
        header('Location: index.php');  // Rediriger vers la page de connexion
        exit;  // Arrêter l'exécution des scripts suivants
    } 
    
    //requete pour recupèrer tous les infos du produit dont id == id produit passé en url et une jointure avec la table commandes et la table utilisateurs

    $query = $data->prepare("SELECT * FROM produits INNER JOIN  commandes ON produits.id = commandes.id_commande  INNER JOIN utilisateurs ON utilisateurs.id = produits.id_user WHERE  produits.id = :id" );

    $query->bindParam(':id', $idProduit);
    $query->execute();
    $results = $query->fetch();

//Recuperation des informations du produit ayant l'id passé en parametre

$_SESSION['id_produit'] = $_GET['id_produit'];

$prix = $results['prix'];
//$com  = $_POST['com'] ;
$id_vendeur = $results['id_user'];
$nom_acheteur = $nom_user ;
$nom_produit = $results['nom_produit'];
  //si user clique sur ajouter au panier
  $quantite_produit = $results['quantite_produit'];
  var_dump($results['quantite_produit']);
 

  if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//on recupere tous les infos en rapport avec l'id produit que user veut ajouter
    $querypanier = $data->prepare("SELECT * FROM paniers WHERE utilisateur_id = :id_user AND produit_id = :id_produit");

      $querypanier->bindParam(':id_user', $id_user);
      $querypanier->bindParam(':id_produit', $idProduit);
      
      $querypanier->execute();

      $panier = $querypanier->fetch();
      
  var_dump($panier['quantite_panier']);
var_dump( $quantite_produit);

      $quantite_panier = $panier['quantite_panier'];

      if( $quantite_produit > $quantite_panier){

if($panier){
//si le produit existe deja dans le panier on modifie seulement la quantite
    $query = $data->prepare("UPDATE paniers SET quantite_panier = quantite_panier + 1 WHERE utilisateur_id = :id_user AND produit_id = :id_produit");
    $query->bindParam(':id_user', $id_user);
      $query->bindParam(':id_produit', $idProduit);
      
      $query->execute();
}else{
//sinon on ajoute le produit dans le panier
    $querypanier = $GLOBALS['data']->prepare("INSERT INTO paniers (utilisateur_id, produit_id, nom_utilisateur, nom_produit, quantite_panier) VALUES (:id_user, :id_produit, :nom_utilisateur, :nom_produit, :quantite_panier)");
    $querypanier->bindParam(':id_user', $id_user);
    $querypanier->bindParam(':id_produit', $idProduit);
    $querypanier->bindParam(':quantite_panier', $quantite_panier);
    $querypanier->bindParam(':nom_utilisateur', $nom_acheteur);
    $querypanier->bindParam(':nom_produit', $nom_produit);
    
    $querypanier->execute();
}
            
      }else{

        echo"Quantité insufficante";

       
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
        <h4> : <?= $results['nom_produit'] ?> ; <?= $results['description'] ?></h4>
        <p> Prix Unitaire : <?= $results['prix'] . " $"?> </p>
        
    </div>
    
    <form method="POST" action="" onsubmit="return commandeChamps();">

    <select name="com" id="com">
                                <option value="1"selected>1</option>
                        
     </select>

    
    </div>
<div class="container">

<p id="successmessage" style="color: green;"><?= $successmessage; ?></p>

<p id="errormessage" style="color: red;"><?= $errormessage; ?></p>

<!--button type="submit" name="submit" >Commander</button-->
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
      