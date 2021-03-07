<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idParent = $_GET['idParent'];

    if($idParent == null){
        print(json_encode("le paramètre 'idParent' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from parent where id='$idParent'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_assoc();
    if($danaInBdd["id"] == $idParent) {
        header('Content-Type: application/json');
        header('idParent:'. $idParent);
        print(json_encode($danaInBdd));
    } else {
        print(json_encode("Cette eleve avec ID=".$idParent." n'existe pas en BDD"));
    }







}

