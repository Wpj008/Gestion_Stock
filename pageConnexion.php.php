<?php if(isset($_GET['identifiant'])) ?>


<?php
function name($text ='Veuillez vous identifier : '){
        
        echo $text ;
        
        $nom = readline('Nom d utilisateur : ');
        $passework = readline('Mot de Passe : ');
        
        return [$nom, $passework];
    }

   // $presentation = name();
    //$time = heure();
    
    //var_dump($presentation); ?>


<?php $_GET['identifiant']; ?>
    

    <?php if($_GET['identifiant'] && $_GET['Mot de passe'] ) {
        echo "connecté";

    }
        
        else {
            
            echo "Identifiqnt incorrect"; 
        }
            ?>

    
    


<!DOCTYPE htmlL>

          <html lang="fr">
                 <head>
                     <meta charset="utf-8">
                     <title></title>
                     <link href="affichage.css" rel="stylesheet"> 

                 </head>

            <body>

                <p>
                    <h1>Bienvenu à vous ! </h1>



                </p>
                <br><br><br><br><br><br>


               
                <form method="get" action="">
                    
                        <fieldset>
                        <legend><h4>Vos identités</h4></legend><br>

                        <br><br>

                        <div class="name">

                        <label for="Identifiant">Nom d'Utilisateur : </label>
                        <input  type="text" id="Identifiant" name="Identifiant" autofocus required><?php  if(isset($_GET['identifiant'])){ echo htmlentities($_GET['identifiant']);}  ?><br><br><br><br>
                        </div><br><br>

                        
                        

                        
                        <div class="password">
                        <label for="Mot de passe">Mot de passe : </label>
                        <input   type="password" id="Mot de passe" name="Mot de passe" autofocus required><?php  if(isset($_GET['Mot de passe'])){ echo htmlentities($_GET['Mot de passe']);}  ?><br><br>
                        

                    </div>

                    </fieldset><br><br>

                    
                    <div class="retour">
                    
                    <input type="submit" value="se connecter">

                    </div><br><br>

                    <div class="compte">
                    <h3>Si vous n'avez pas de compte veillez créer un compte !!</h3><br><br>


                   <!-- <a href="page_Accueil.php">Passer au menu</a>-->



                    <a href="CreationCompte.html">Créer un compte</a>


                </div>




                </form>


              </body>
 
           
           
           


</html>