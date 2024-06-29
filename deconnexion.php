<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// détruire la session.
session_destroy();

// Rediriger vers la page d'accueil
header("Location: index.php");
exit;
?>

