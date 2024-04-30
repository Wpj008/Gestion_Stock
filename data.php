<?php
try
{
	$data = new PDO('mysql:host=localhost;dbname=gestionstock;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>