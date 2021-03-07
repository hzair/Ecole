<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from eleve";
    $result2 = $mysqli->query($findSql);
    while($row=$result2->fetch_assoc()){
        $output[]=$row;
    }
    header('Content-Type: application/json');
    print(json_encode($output));

    /* Fermeture de la connexion */
    $mysqli->close();





}

