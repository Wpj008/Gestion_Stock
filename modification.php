<?php
session_start();
include "data.php";
include "header.php";


$idProduit = $_GET['id_produit'];





if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {
    

    $commande = $_POST['commande'];
    $prix =  $_POST['prix'];

if($commande > 0){
    

$query = $data->prepare( "UPDATE produits SET quantite = :quantite WHERE id = :id");
$query->bindParam(':quantite', $commande);
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



<form method="POST" action="">

    <label for="commande">Quelle est la qauntité : </label><br><br>
    <input id="commande" name="commande" type="text" ><br><br><br><br>

    <label for="prix">Quel est le prix :</label><br><br>
    <input id="prix" name="prix" type="text" ><br><br><br><br>

    <button type="submit" name="submit">Enregistrer les modifications</button>
</form>



<?php
include "footer.php";
?>