<?php
session_start();
include "data.php";
include "header.php";


$idProduit = $_GET['id_produit'];





if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {
    
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $commande = $_POST['commande'];
    $prix =  $_POST['prix'];

if($commande > 0){
    

$query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
$query->bindParam(':quantite', $commande);
$query->bindParam(':id', $idProduit);

$query->execute();


}

if($nom){

    
$query = $data->prepare( "UPDATE produits SET  nom_produit =:nom WHERE id = :id");

$query->bindParam(':nom', $nom);
$query->bindParam(':id', $idProduit);

$query->execute();



}


if($description){


    
    $query = $data->prepare( "UPDATE produits SET  description =:description WHERE id = :id");
    
    $query->bindParam(':description', $description);
    $query->bindParam(':id', $idProduit);
    
    $query->execute();
    
    
    
    }
    

    if($prix > 0 ){


    
        $query = $data->prepare( "UPDATE produits SET  prix =:prix WHERE id = :id");
        
        $query->bindParam(':prix', $prix);
        $query->bindParam(':id', $idProduit);
        
        $query->execute();
        
        
        
        }
        
            


}





?>

<br><br><br><br><br><br>
<div class="container">
<form method="POST" action="">

<label for="nom">Quelle est le nom du produit : </label><br><br>
    <input id="nom" name="nom" type="text" ><br><br><br><br>

    <label for="description">Description:</label><br><br>
        <textarea id="description" name="description" ></textarea><br><br><br><br>

    <label for="commande">Quelle est la qauntité : </label><br><br>
    <input id="commande" name="commande" type="text" ><br><br><br><br>

    <label for="prix">Quel est le prix :</label><br><br>
    <input id="prix" name="prix" type="text" ><br><br><br><br>

    <button type="submit" name="submit">Enregistrer les modifications</button><br><br><br>
</form>
</div>

<br><br><br><br><br><br>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>

    
    <style>      body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .username {
            text-align: center;
            margin: 1rem 0;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            box-sizing: border-box;
        }
        .container label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: inline-block;
        }
        .container input, .container textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .container button {
            color: white;
            background-color: green;
            border: none;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 1rem;
            cursor: pointer;
            font-size: 1rem;
        }
        .container button:hover {
            background-color: darkgreen;
        }
    </style>

</head>

<?php
include "footer.php";
?>