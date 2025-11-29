<?php
session_start();
include "data.php";
include "functions/categoryFunction.php";
include "header.php";
include "functions/userFunction.php";

$checkLog = checkLogin();//check connection



$callCategory = selectAllCategory();

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

$nameCategory = htmlspecialchars($_POST['name_category']);
$categoryDescription = htmlspecialchars($_POST['category_description']);


$categories = registerCategory($nameCategory, $categoryDescription);

echo $categories;




}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_category.css">
    <title>Category</title>
</head>
<body>
    

<div class="category-container">

    <!-- Header -->
    <div class="category-header">
        <h1>Gestion des Catégories</h1>
    </div>

    <!-- Tableau des catégories -->
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Produits</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>

            <?php  $i = 0;
            
            foreach ($callCategory as $categori) {
                
                $i++?>
              
           
            <tr>
                <td><?= $i ?></td>
                <td><?=  $categori['name_category'] ?></td>
                <td><?=  $categori['category_description'] ?></td>
                <td>12</td>
                <td><span class="badge success">Actif</span></td>
                <td>
                    <button class="btn small edit">Modifier</button>
                    <button class="btn small delete">Supprimer</button>
                </td>
            </tr>
            <?php } ?>

            
            </tbody>

        </table>
    </div>

    <!-- Formulaire -->
    <div class="category-form">
        <h2>Ajouter / Modifier une Catégorie</h2>

        <form method="POST">
            <div class="form-grid">

                <div  class="form-group">
                    <label for="name_category">Nom de la catégorie</label>
                    <input id="name_category" name="name_category" type="text" placeholder="Nom" required>
                </div>

                <div class="form-group">
                    <label>Statut</label>
                    <select>
                        <option>Actif</option>
                        <option>Inactif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_description">Description</label>
                    <textarea id="category_description" name="category_description" type="text" placeholder="Description" required></textarea>
                </div>

            </div>

            <input class="btn-save" type="submit" name="submit" value="Enregistrer">
            
        </form>
    </div>
</div>




</body>
</html>