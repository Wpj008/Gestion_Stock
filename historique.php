<?php
session_start();
include "data.php";
include "header.php";

$idUser = $_SESSION['id_user'] ;
$successMessage = 0;


//Jointure des tables produits et commandes et affichage de l'historique de commande

$query = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id WHERE utilisateur_id = :id ");

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

    echo "<h2> NOUVELLES COMMANDES  </h2> ";


    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($results as $result) {

        $etat_commannde = $result['nom_etat'];



        if( $etat_commannde === 'En cours'){
        
        echo "<tr>";
      
        echo "<td>" . $i++ . "</td>";
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

} else {
    echo "Aucune commande à afficher.";
}



//Jointure des tables produits et commandes et affichage de l'historique de commande

$valider = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id WHERE utilisateur_id = :id ");

//$query = $data->prepare("SELECT * FROM  commandes WHERE utilisateur_id = :id");


$valider->bindParam(':id',$idUser );

 $valider->execute();
 $resultats = $valider->fetchAll(); ?>


<?php
if ($resultats) {

    echo "<h2> COMMANDES VALIDEES </h2> ";

    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($resultats as $resultat) {

        $etat_commannde = $resultat['nom_etat'];



        if( $etat_commannde === 'Validée'){

            "<p id='successMessage' style='color: green;'>" .$successMessage;
            $successMessage = $resultat['nom_etat'];


        
        echo "<tr>";
      
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . $resultat['nom_produit'] . "</td>"; 
        echo "<td>" . $resultat['description'] . "</td>";
        echo "<td>" . $resultat['date_commande'] . "</td>";
        echo "<td>" . $resultat['quantite'] . "</td>";
        echo "<td>" . $resultat['prix_commande'] . ' $'."</td>";        
        echo "<td>" . "<p id='successMessage' style='color: orange;'>" .$successMessage . "</td>";
        
        echo "</tr>";
     
} 
    }
    echo "</table>";

} else {
    echo "Aucune commande à afficher.";
}




//Jointure des tables produits et commandes et affichage de l'historique de commande

$livrer = $data->prepare("SELECT * FROM produits INNER JOIN commandes ON produits.id = commandes.produit_id INNER JOIN etats_commande ON etats_commande.id = commandes.etat_id WHERE utilisateur_id = :id ");

//$query = $data->prepare("SELECT * FROM  commandes WHERE utilisateur_id = :id");


$livrer->bindParam(':id',$idUser );

 $livrer->execute();
 $livreurs = $livrer->fetchAll(); ?>


<?php
if ($livreurs) {

    echo "<h2> COMMANDES LIVREES </h2> ";
    echo "<table>"; 
    echo "<tr><th>N°</th><th>Nom du produit</th><th>Info sur le produit</th><th>Date de commande</th><th>Quantité commandée</th><th>Prix de la commande</th><th>Etat de la commande</th></tr>"; 

    $i = 1;
   
    foreach ($livreurs as $livreur) {

        $etat_commannde = $livreur['nom_etat'];



        if( $etat_commannde === 'Livrée'){

            $successMessage = $livreur['nom_etat'];
        
        echo "<tr>";
      
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . $livreur['nom_produit'] . "</td>"; 
        echo "<td>" . $livreur['description'] . "</td>";
        echo "<td>" . $livreur['date_commande'] . "</td>";
        echo "<td>" . $livreur['quantite'] . "</td>";
        echo "<td>" . $livreur['prix_commande'] . ' $'."</td>";        
        echo "<td>" . "<p id='successMessage' style='color: green;'>" .$successMessage  . "</td>";
        
        echo "</tr>";
     
} 
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