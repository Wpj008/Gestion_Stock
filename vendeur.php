<?php 
session_start();
include "data.php";
include "header.php";


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
        echo "<tr><th>N°</th><th>Nom du produit</th><th>Info sur le produit</th><th>Quantité en stock</th><th>Prix </th><th>Actions </th></tr>"; 

        $i = 1;
        foreach($produits as $produit){
            

        
    ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/historique.css">
    <link rel="stylesheet" href="css/ajoutProduit.css">
    
    
    <script>
    //Fonction Js boutton de roulant

        function afficherFormulaire() {
            var formulaire = document.getElementById("formulaire");
            if (formulaire.style.display === "none") {
                formulaire.style.display = "block";
            } else {
                formulaire.style.display = "none";
            }
        }
    </script>
</head>
<body>




<tr>
            <td> <?= $i++ ?></td>
            <td> <?= $produit['nom'] ?> </td>
            <td> <?= $produit['description'] ?> </td>
            <td> <?= $produit['quantite'] ?> </td>
            <td> <?= $produit['prix']." $" ?> </td> 
            <td > <a href="modification.php ? id_produit= <?= $produit ['id'] ?> ">Modifier</a> &nbsp;&nbsp;
             <a href="delete.php ? id_produit= <?= $produit ['id'] ?> ">Supprimer</a> </td>
           
            </tr>
        <?php } ?> 

        </table>




    <button onclick="afficherFormulaire()">Ajouter un produit</button>

<!-- Affichage du formulaire de l'ajout produit dans la bdd-->

    <div id="formulaire">
        <form action="" method="POST">
            <label for="nom">Nom du produit:</label><br>
            <input type="text" id="nom" name="nom"><br>
            <label for="description">Description:</label><br>
            <input type="text" id="description" name="description"><br>
            <label for="quantite">Quantité en stock:</label><br>
            <input type="number" id="quantite" name="quantite"><br>
            <label for="prix">Prix:</label><br>
            <input type="text" id="prix" name="prix"><br>
            
            <button type="submit" name="submit">Ajouter le produit</button>
                       
        </form>
    </div>

    <br><br><br><br><br><br>
</body>
</html>


<?php
include "footer.php";
?>






