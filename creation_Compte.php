<?php if(isset($_GET['identifiant'])) ?>


<?php
function name($text ='Veuillez vous identifier : '){
        
        echo $text ;
        
        $nom = readline('Nom : ');
        
        $post_nom = readline('Post-Nom : ');
        
        $prenom = readline('Prenom : ');

        $nom_utilisateur = readline('Nom d utilisateur : ');

        $passework = readline('Mot de Passe : ');

        $email = readline('Email : ');
        
        return [$nom, $passework];
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
                        <legend>Vos identités</legend><br>
                        <div class="name">

                            
                        <label for="Nom">Nom : </label>
                        <input  type="text" id="Nom" name="Nom" autofocus required><?php  if(isset($_GET['Nom'])){ echo htmlentities($_GET['Nom']);}?><br><br>

                        
                        <label for="Post-Nom">Post-Nom : </label>
                        <input  type="text" id="Post-Nom" name="Post-Nom" autofocus required><?php  if(isset($_GET['Post-Nom'])){ echo htmlentities($_GET['Post-Nom']);}?><br><br>

                        
                        <label for="Prenom">Prénom : </label>
                        <input  type="text" id="Prenom" name="Prenom" autofocus required><?php  if(isset($_GET['Prenom'])){ echo htmlentities($_GET['Prenom']);}?><br><br>

                        </div>

                        </fieldset><br><br>
                        
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
                            <p>SEXE</p>
                        <input type="radio" name="sexe" id="sexe">
                        <label for="sexe">M</label>
                        <input type="radio" name="sexe" id="sexe">
                        <label for="sexe">F</label><br><br>
                        
                        <label for="start">Date de naissance : </label>
                        <input type="date" id="start" name="trip-start" value="2010-01-01" min="1994-01-01" max="2010-12-31"><br><br>
                        

                    </ul>

                </div>
                    </fieldset><br><br>

                    <div class="retour">
                    
                    <input type="submit" value="créer compte">

                    </div>


                    




                </form>


              </body>
 
           
           
           


</html>