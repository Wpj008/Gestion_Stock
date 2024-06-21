<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="css/header-footer.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="creation_Compte.php">Inscription</a></li>
                <li><a href="#"> Mon compte</a></li> 

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li><a href="admin/login.php">Espace Admin</a></li>
                <?php endif; ?>

                
                <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "vendeur"): ?>
                    <li><a href="vendeur.php">Espace Vendeur</a></li>
                <?php endif; ?>

                <!-- <img src="" alt="Compte" style="vertical-align: middle;"> -->

                <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "acheteur"): ?>

                  <li><a href="historique.php">Historique</a></li>

                <?php endif; ?>


                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    
    <?php if (isset($_SESSION['username'])): ?>

<?= $_SESSION['username'] ?>
<?php endif; ?>


</body>
</html>
