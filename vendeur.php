<?php 
session_start();
include "data.php";
include "header.php";

$id = $_SESSION['id_user'];



//Recuperation de toutes les informations dans la table produits

$query = $data->prepare("SELECT * FROM produits " );

$query->execute();
  
$produits = $query->fetchAll();



if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//Recuperation des champs remplis par l'utilisateur

$nom = $_POST['nom'];
$quantite = $_POST['quantite'];
$description = $_POST['description'];
$prix = $_POST['prix'];

//Insertion des données saisies par l'user dans la bdd dans la table produit

$query = $GLOBALS['data']->prepare("INSERT INTO produits (nom, quantite, description, prix) VALUES (:nom, :quantite, :description, :prix)");
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
            <td> <?= $produit['nom'] ?> </td>
            <td> <?= $produit['description'] ?> </td>
            <td> <?= $produit['quantite'] ?> </td>
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
include "footer.php";
?>






