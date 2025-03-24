<?php

    $serveur = "localhost";
    $dbname = "usermanagement";
    $user = "root";
    $pass = "";
    

    try {
        $db = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        exit;
    }
?>