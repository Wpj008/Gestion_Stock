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
               

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li><a href="admin/login.php">Espace Admin</a></li>
                <?php endif; ?>

                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "gestionnaire"): ?>
                    <li><a href="add_sale.php">Espace Vendeur</a></li>
                    <li><a href="add_purchase.php">Stock</a></li>
                    <li><a href="add_supplier.php"> Fournisseur</a></li>
                    <li><a href="dataUser.php"> Mon compte</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php endif; ?>

                <!-- <img src="" alt="Compte" style="vertical-align: middle;"> -->

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "employe"): ?>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="add_purchase.php">Stock</a></li>
                    <li><a href="dataUser.php"> Mon compte</a></li>
                    <li><a href="add_sale.php"> Vente</a></li>
                  <li><a href="logout.php">Déconnexion</a></li>

                <?php endif; ?>


            </ul>
        </nav>
    </header>

    
    <?php if (isset($_SESSION['username'])): ?>

<?/*= $_SESSION['username']*/ ?>
<?php endif; ?>


</body>
</html>
