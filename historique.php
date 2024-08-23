<?php
session_start();
include "data.php";
include "header.php";

$idUser = $_SESSION['id_user'] ;

//Jointure des tables etat commande et commandes 


$etatcommandes = $data->prepare("SELECT * FROM etats_commande INNER JOIN commandes ON etats_commande.id = commandes.etat_id");

$etatcommandes->execute();

 $etats = $etatcommandes->fetchAll();
 foreach ($etats as $etat) {

    $etat_commande = $etat['nom'];
    
 }



//Jointure des tables produits et commandes et affichage de l'historique de commande

$query = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id WHERE utilisateur_id = :id");

//$query = $data->prepare("SELECT * FROM  commandes WHERE utilisateur_id = :id");


$query->bindParam(':id',$idUser );

 $query->execute();
 $results = $query->fetchAll();


 //Affichage du nombre total de commande effectuée selon id_user

 $query = $data->prepare("SELECT COUNT(*) AS total FROM commandes WHERE utilisateur_id = :id ");

 $query->bindParam(':id', $idUser);

 $query->execute();

 $valeur = $query->fetch();?>

<?php
if ($results) {
    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($results as $result) {
        
        echo "<tr>";
      
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . $result['nom'] . "</td>"; 
        echo "<td>" . $result['description'] . "</td>";
        echo "<td>" . $result['date_commande'] . "</td>";
        echo "<td>" . $result['quantite'] . "</td>";
        
        echo "<td>" . $etat_commande .  "</td>";
        
        echo "</tr>";
    }  

    echo "</table>";
} else {
    echo "Aucune commande à afficher.";
}

echo "<div class='total-orders'>Total des commandes effectuées : " . $valeur['total'] . "</div>";
?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/historique.css">
</head>
<body>

<br><br><br><br><br>
</body>
</html>

<?php
include "footer.php";
?>