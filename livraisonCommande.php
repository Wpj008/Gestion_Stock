<?php 
session_start();
include "data.php";
include "header.php";


//Jointure des tables produits et commandes et affichage de l'historique de commande

$query = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id INNER JOIN utilisateurs ON utilisateurs.id = commandes.utilisateur_id");





 $query->execute();
 $results = $query->fetchAll(); ?>

<?php
if ($results) {
    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom de l'acheteur</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($results as $result) {

        $etat_commannde = $result['nom_etat'];

        if( $etat_commannde === 'Validée'){
        
        echo "<tr>";
      
        echo "<td>" . $i++ . "</td>";
        
        echo "<td>" . $result['nom'] . "</td>";
        echo "<td>" . $result['nom_produit'] . "</td>"; 
        echo "<td>" . $result['description'] . "</td>";
        echo "<td>" . $result['date_commande'] . "</td>";
        echo "<td>" . $result['quantite'] . "</td>";
        echo "<td>" . $result['prix_commande'] . ' $'."</td>";
        
        
        
           
             echo  "<td>" ."<a href='livraison.php?id_commande=" . $result['id_commande'] ." class='btn btn-primary'>Livrer</a>";
        
         } 
         
        
        
        echo "</tr>";
    }  

    echo "</table>";
} else {
    echo "Aucune commande à afficher.";
}



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