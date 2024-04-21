
<?php

    include_once 'fonction.php';

    var_dump(name());

    include_once 'fonction.php';

    var_dump(date_produit());

    include_once 'fonction.php';

    var_dump(quantite());

    include_once 'foncton.php';

    var_dump(retour_oui_non(''));





?>

<!DOCTYPE htmlL>

          <html lang="fr">
                 <head>
                     <meta charset="utf-8">
                     <title></title>
                     <link href="connexion.css" rel="stylesheet"> 

                 </head>

            <body>

                <h1>Bienvenu...</h1>

                <h3>Quelle Opèration désirez-vous éffectuer ? </h3>
                <ul> <?php echo " 1. Consulter le stock "?>
                    <?php echo " 2. Ajouter un produit dans le stock "?>
                   <?php echo " 3. Supprimer un produit du stock "?>   
                   <?php echo " 4. Deconnexion "?>       
            
            </ul>
                <?php $utilisateur = null;
                $utilisateur = (int)readline();
                
                ?>
            <input  type="number"  name="chiffre"  >


            <?php 
                  if($utilisateur === 1){

                    echo "Liste des produits";
                  }

                  elseif($utilisateur === 2){

                    $nomProduit = name();
                    $dateProduit = date_produit();
                    $quantiteProduit = quantite();

                    $reponseProduit = retour_oui_non('Voulez vous continuer ?');
                  
                  }

                  elseif($utilisateur === 3){

                    echo "Produit supprimer";
                  }

                  else{

                    echo"merci pour votre visite";
                  }
            
            
            
            ?>


    </body>
 
           
           
           


    </html>