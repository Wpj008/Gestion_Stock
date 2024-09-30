<?php 
session_start();
include "data.php";
include "header.php";



//Jointure des tables produits et commandes et affichage de l'historique de commande

$query = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id INNER JOIN utilisateurs ON utilisateurs.id = commandes.utilisateur_id");





 $query->execute();
 $results = $query->fetchAll();


 //Affichage du nombre total de commande effectuée selon id_user

 $query = $data->prepare("SELECT COUNT(*) AS total FROM commandes ");



 $query->execute();

 $valeur = $query->fetch();?>

<?php
if ($results) {

    
    echo "<h2>NOUVELLES COMMANDES </h2> ";
    
  
    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom de l'acheteur</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($results as $result) {

        $etat_commannde = $result['nom_etat'];

        if( $etat_commannde === 'En cours'){
        
        echo "<tr>";

        
      
        echo "<td>" . $i++ . "</td>";
        
        echo "<td>" . $result['nom'] . "</td>";
        echo "<td>" . $result['nom_produit'] . "</td>"; 
        echo "<td>" . $result['description'] . "</td>";
        echo "<td>" . $result['date_commande'] . "</td>";
        echo "<td>" . $result['quantite'] . "</td>";
        echo "<td>" . $result['prix_commande'] . ' $'."</td>";
        
        echo "<td>" . $result['nom_etat'] . "</td>";
        
        
        echo "</tr>";
    } 
}

    echo "</table>";
} 

else {
    echo "Aucune commande à afficher.";
}



$valider = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id INNER JOIN utilisateurs ON utilisateurs.id = commandes.utilisateur_id");





 $valider->execute();
 $resultats = $valider->fetchAll();

?>

<?php
if ($resultats) {

    
    echo "<h2> COMMANDES VALIDEES </h2> ";
    
  
    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom de l'acheteur</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($resultats as $resultat) {

        $etat_commannde = $resultat['nom_etat'];



    if( $etat_commannde === 'Validée'){
        
        echo "<tr>";

        
      
        echo "<td>" . $i++ . "</td>";
        
        echo "<td>" . $resultat['nom'] . "</td>";
        echo "<td>" . $resultat['nom_produit'] . "</td>"; 
        echo "<td>" . $resultat['description'] . "</td>";
        echo "<td>" . $resultat['date_commande'] . "</td>";
        echo "<td>" . $resultat['quantite'] . "</td>";
        echo "<td>" . $resultat['prix_commande'] . ' $'."</td>";
        
        echo "<td>" . $resultat['nom_etat'] . "</td>";
       // echo  "<td>" ."<a href='livraison.php?id_commande=" . $result['id_commande'] ." class='btn btn-primary'>Livrer</a>";
        
        echo "</tr>";
    } 





}

    echo "</table>";
} 

else {
    echo "Aucune commande à afficher.";
}





$livrer = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id INNER JOIN utilisateurs ON utilisateurs.id = commandes.utilisateur_id");





 $livrer->execute();
 $livraison = $livrer->fetchAll();

?>

<?php
if ($livraison) {

    
    echo "<h2> COMMANDES LIVREES </h2> ";
    
  
    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom de l'acheteur</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($livraison as $livreur) {

        $etat_commannde = $livreur['nom_etat'];



    if( $etat_commannde === 'Livrée'){
        
        echo "<tr>";

        
      
        echo "<td>" . $i++ . "</td>";
        
        echo "<td>" . $livreur['nom'] . "</td>";
        echo "<td>" . $livreur['nom_produit'] . "</td>"; 
        echo "<td>" . $livreur['description'] . "</td>";
        echo "<td>" . $livreur['date_commande'] . "</td>";
        echo "<td>" . $livreur['quantite'] . "</td>";
        echo "<td>" . $livreur['prix_commande'] . ' $'."</td>";
        
        echo "<td>" . $livreur['nom_etat'] . "</td>";
       // echo  "<td>" ."<a href='livraison.php?id_commande=" . $result['id_commande'] ." class='btn btn-primary'>Livrer</a>";
        
        echo "</tr>";
    } 





}

    echo "</table>";
} 

else {
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