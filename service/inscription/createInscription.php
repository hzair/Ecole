<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $sql = "INSERT INTO `inscription` (`id`, `id_pere`, `id_mere`, `date`, `parents_separe`) VALUES (NULL, NULL, NULL, NOW(), NULL)";

    $result = $mysqli->query($sql);
    if($result){
        $sql2 = "SELECT MAX(id) FROM inscription ";
        $result2 = $mysqli->query($sql2);
        $data2 = $result2->fetch_array();
        print(json_encode($data2["MAX(id)"]));
    } else {
        print(json_encode("erreur de creation inscription : " . $result));
    }

    /* Fermeture de la connexion */
    $mysqli->close();





}

