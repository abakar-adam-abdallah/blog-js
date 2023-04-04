<?php

// Dans cette page on se connecte à notre base de données. 
// Il suffira d'utiliser un include ou require_once
// pour utiliser ce code dans le reste des fichiers.

// Connexion à la base de données (pas pour Plesk)

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Echec de connexion " . $conn->connect_error);
}

?>  