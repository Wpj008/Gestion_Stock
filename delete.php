<?php
session_start();
include "data.php";
include "header.php";

//Recuperation de l'id envoyé en parametre

$idProduit = $_GET['id_produit'];


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

//Suppression du produit dont l'id a été envoyé en parametre 

    $query = $data->prepare(" DELETE FROM produits WHERE id =:id");
    
$query->bindParam(':id', $idProduit);

$query->execute();

    
    //Redirection à la page vendeur.php
    
        header('Location: vendeur.php');
        
        
    
    }

?>


<h2>Vous voulez supprimer ce produit ? </h2><br><br>


<form method="POST" action="">

<button type="submit" name="submit">Supprimer definitivement</button>

</form>



<?php
include "footer.php";
?>