<?php if(isset($_GET['identifiant'])) ?>

<?php //CONNEXION BASE DE DONNEES 

try
{
	$user= new PDO('mysql:host=localhost;dbname=gestionstock;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>

<?php
$requete = $user->prepare('SELECT * FROM utilisateurs');
?>

<?php
$requete->execute();
$recipes = $requete->fetchAll();
?>

<?php 
$entre = 'INSERT INTO "utilisateurs" ("nom", "email", "mot de passe", "type")';

?>





<?php
function name($text ='Veuillez vous identifier : '){
        
        echo $text ;
        
       
        $nom_utilisateur = readline('Nom d utilisateur : ');

        $passework = readline('Mot de Passe : ');

        $email = readline('Email : ');
        
        return [$nom_utilisateur, $passework];
    }
 ?>


    

    <?php if($_GET['identifiant'] && $_GET['Mot de passe'] ) {
        echo "connecté";

    }
        
        else {
            
            echo "Identifiant incorrect"; 
        }
            ?>






<!DOCTYPE htmlL>

          <html lang="fr">
                 <head>
                     <meta charset="utf-8">
                     <title></title>
                     <link href="Creation_Compte.css" rel="stylesheet"> 

                 </head>

            <body>

                <p>
                    <h1>Bienvenu à vous ! </h1><br>


                   <h2> veillez créer votre compte !</h2><br><br>

                        <h3>Complètez vos identités</h3>

                </p>
                <br><br>


                
               
                <form method="get" action="">
                    
                        
                    <fieldset>

                        <div class="password"> 

                       <label for="Identifiant">Nom d'Utilisateur : </label>
                        <input  type="text" id="Identifiant" name="Identifiant" autofocus required><?php  if(isset($_GET['identifiant'])){ echo htmlentities($_GET['identifiant']);}?><br><br>
                   
                        <label for="Mot de passe">Mot de passe : </label>
                        <input   type="password" id="Mot de passe" name="Mot de passe" autofocus required><?php  if(isset($_GET['Mot de passe'])){ echo htmlentities($_GET['Mot de passe']);}?><br><br>

                    </div>
                    
                    </fieldset><br><br>

                        
                    

                    

                <br><br>

                   <fieldset>

                    <div class="adresse">
                        
                        <ul>
                        <label for="email">email : </label>
                        <input  type="email" id="email" name="email" placeholder="abcemail@gmail.com" autofocus required><?php  if(isset($_GET['email'])){ echo htmlentities($_GET['email']);}?><br><br>
                            <p>FONCTION : </p>
                        <input type="radio" name="acheteur" id="acheteur" value="acheteur">
                        <label for="achteur">Acheteur</label><br><br>
                        <input type="radio" name="vendeur" id="vendeur" value="vendeur">
                        <label for="vendeur">Vendeur</label><br><br>
                        
                        

                    </ul>

                </div>
                    </fieldset><br><br>

                    <div class="retour">
                    
                    <input type="submit" value="créer compte">

                    </div>


                    




                </form>


              </body>
 
           
           
           


</html>