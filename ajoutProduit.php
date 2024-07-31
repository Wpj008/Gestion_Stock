
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
?>




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/ajoutProduit.css">
</head>
<body>
<style>

.formulaire {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin-top: 20px;
  
}

 .formulaire form {
    display: flex;
    flex-direction: column;
}

.formulaire label {
    margin-bottom: 5px;
    font-weight: bold;
}

.formulaire input[type="text"],
.formulaire input[type="number"] {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
}

.formulaire button {
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.formulaire button:hover {
    background-color: #218838;
}

    

</style>






<div class="formulaire">

        <form action="" method="POST">
            <label for="nom">Nom du produit:</label><br>
            <input type="text" id="nom" name="nom" required><br>
            <label for="description">Description:</label><br>
            <input type="text" id="description" name="description" required><br>
            <label for="quantite">Quantité en stock:</label><br>
            <input type="number" id="quantite" name="quantite" required><br>
            <label for="prix">Prix:</label><br>
            <input type="text" id="prix" name="prix" required><br>
            
            <button type="submit" name="submit">Ajouter le produit</button>

        </form>

</div>
                       
</body>
</html>


<?php 


$query = $data->prepare("SELECT * FROM utilisateurs WHERE 'type' =  vendeur" );

$query->execute();
  
$produits = $query->fetchAll();

foreach($produits as $produit){

    echo $produit['nom'];
}


?>