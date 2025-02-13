<?php 
session_start();
include "data.php";
include "header.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || $_SESSION['type'] !== 'vendeur') {
    
    header('Location: index.php');  // Rediriger vers la page de connexion
  
   exit;  // Arrêter l'exécution des scripts suivants
}

$id = $_SESSION['id_user'];



//Recuperation de toutes les informations dans la table produits

$query = $data->prepare("SELECT * FROM produits WHERE id_user = :id_user" );
$query->bindParam(':id_user', $id);

$query->execute();
  
$produits = $query->fetchAll();



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//Recuperation des champs remplis par l'utilisateur

$nom = $_POST['nom'];
$quantite = $_POST['quantite'];
$description = $_POST['description'];
$prix = $_POST['prix'];

//Insertion des données saisies par l'user dans la bdd dans la table produit

$query = $GLOBALS['data']->prepare("INSERT INTO produits (nom_produit, quantite_produit, description, prix) VALUES (:nom, :quantite, :description, :prix)");
$query->bindParam(':nom', $nom);
$query->bindParam(':quantite', $quantite);
$query->bindParam(':description', $description);
$query->bindParam(':prix', $prix);

$query->execute(); 




}

//Afficher des infos de la bdd dans un tableau
    
        echo "<table>"; 
        echo "<tr><th>N°</th><th>Nom du produit</th><th>Info sur le produit</th><th>Quantité en stock</th><th>Prix </th><th>Etat du Produit </th><th>Actions </th></tr>"; 

        $i = 1;
        echo "papapapapa";
        foreach($produits as $produit){
            

        
    ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/historique.css">
    
    </head>

<body>




<tr>
            <td> <?= $i++ ?></td>
            <td> <?= $produit['nom_produit'] ?> </td>
            <td> <?= $produit['description'] ?> </td>
            <td> <?= $produit['quantite_produit'] ?> </td>
            <td> <?= $produit['prix']." $" ?> </td> 
            <td> <?php if ($produit['etat_produit'] === 1){?>
                <p id="successMessage" style="color: green;"><?= $successMessage = "Activé"; ?>
            <?php } else{ ?> <p id="errorMessage" style="color: red;"><?= $errorMessage = "Desactivé";}?> </td> 
            <td>
  <a href="modification.php?id_produit=<?= $produit['id'] ?>" class="btn btn-primary">Modifier</a>
  &nbsp;&nbsp;
  <a href="delete.php?id_produit=<?= $produit['id'] ?>" class="btn btn-danger">Désactiver</a>
  &nbsp;&nbsp;
  <a href="activation.php?id_produit=<?= $produit['id'] ?>" class="btn btn-primary">Activer</a>
</td>
            </tr>
        <?php } ?> 

        </table>

       


    <br><br><br><br><br><br>
</body>
</html>


<?php

echo "papapapapa";


$querynotification = $data->prepare("SELECT * FROM notifications INNER JOIN produits ON produits.id = notifications.id_notification INNER JOIN utilisateurs ON utilisateurs.id = notifications.id_notification WHERE vendeur_id = :id_vendeur");

$querynotification->bindParam(':id_vendeur', $id);

$querynotification->execute();

$notification = $querynotification->fetchAll();

var_dump($querynotification);

foreach($notification as $notifications) {?>


     
         <?= var_dump($notifications['nom_produit']);?>
         <p> <?= $notifications['message'] ?>. </p>
         <small>Acheteur : <?= $notifications['nom']; ?> | Produit : <?= $notifications['nom_produit']; ?> | <?= $notifications['date_notification']; ?></small>
         <a href="confirmer_commande.php?id=<?php //echo $notifications['commande_id']; ?>">Confirmer la commande</a>
     


     <?= var_dump($notifications['message']);?>



<?= var_dump($notifications['nom_produit']);?>
         <p> <?= $notifications['message'] ?>. </p>
         <small>Acheteur : <?= $notifications['nom']; ?> | Produit : <?= $notifications['nom']; ?> | <?= $notifications['date_notification']; ?></small>
         <a href="confirmer_commande.php?id=<?php //echo $notifications['commande_id']; ?>">Confirmer la commande</a>
<?php } ?>

<?php

echo "papapapapa";
//include "footer.php";
?>



