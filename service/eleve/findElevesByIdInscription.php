<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idInscription = $_GET['idInscription'];

    if ($idInscription == null) {
        print(json_encode("le paramètre 'idInscription' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql = "select * from eleve where id_inscription='$idInscription'";
    $result = $mysqli->query($findSql);
    while($row=$result->fetch_assoc()){
        $output[]=$row;
    }
    header('Content-Type: application/json');
    print(json_encode($output));

}

