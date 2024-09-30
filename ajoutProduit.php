
<?php 
session_start();
include "data.php";
include "header.php";

$successmessage = "";
$errormessage = "";

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
$etat_produit = 1 ;

if(isset($errormessage)){

   echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
}

// Testons si le fichier a bien été envoyé et s'il n'y a pas des erreurs
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    // Testons, si le fichier est trop volumineux
    if ($_FILES['image']['size'] > 1000000) {
        $errormessage = "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse";

        echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
        return;
    }
    // Testons, si l'extension n'est pas autorisée
    $fileInfo = pathinfo($_FILES['image']['name']);
    $extension = $fileInfo['extension'];
    $allowedExtensions = [ 'jpg','jpeg', 'gif', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        $errormessage = "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";

        echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
        return;
    }
    // Testons, si le dossier uploads est manquant
    $path ='img/';
    if (!is_dir($path)) {
        $errormessage = "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";

        echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
        return;
    }

    //Verification de tous les champs

    if (!empty($nom === "" || $description === "" || $quantite === "" || $prix === "")) {
        $errormessage = "Veuillez remplir tous les champs ";

        echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
        return;
        
    }

    if($quantite <= 0 || $prix <= 0){

        $errormessage = "La quantité ou le prix ne peut pas être inferieure ou égale à 0";

        echo' <p id="errormessage" style="color: red;">' .$errormessage.'</p>';
        return;
    
    }

    // Déplacez le fichier dans le répertoire de destination
    $destination = $path . basename($_FILES['image']['name']);

    $image = $destination;

//Insertion des données saisies par l'user dans la bdd dans la table produit

$query = $GLOBALS['data']->prepare("INSERT INTO produits (nom_produit, quantite, description, prix, image, etat_produit) VALUES (:nom, :quantite, :description, :prix, :image, :etat_produit)");
$query->bindParam(':nom', $nom);
$query->bindParam(':quantite', $quantite);
$query->bindParam(':description', $description);
$query->bindParam(':prix', $prix);
$query->bindParam(':etat_produit', $etat_produit);
$query->bindParam(':image', $image);


$query->execute(); 




    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
       $successmessage ="Le fichier a été téléchargé avec succès.";
    } else {
        $errormessage = "Échec du téléchargement du fichier.";
    }
} else {
    $errormessage = "Aucun fichier ou une erreur est survenue lors du téléchargement.";
}


}
?>




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/ajoutProduit.css">
    <script src="js/verification.js"></script>
</head>
<body>

<div class="formulaire">

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nom">Nom du produit:</label><br>
            <input type="text" id="nom" name="nom" required><br>
            <label for="description">Description:</label><br>
            <input type="text" id="description" name="description" required><br>
            <label for="quantite">Quantité en stock:</label><br>
            <input type="number" id="quantite" name="quantite" required><br>
            <label for="prix">Prix:</label><br>
            <input type="text" id="prix" name="prix" required><br>
            <input type="file" id="image" name="image"><br>
            <p id="successmessage" style="color: green;"><?= $successmessage; ?></p>

            <p id="errormessage" style="color: red;"><?= $errormessage; ?></p>
            
            <button type="submit" name="submit" >Ajouter le produit</button>

        </form>

</div>
                       
</body>
</html>

