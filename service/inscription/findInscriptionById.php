<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idInscription = $_GET['idInscription'];

    if($idInscription == null){
        print(json_encode("le paramètre 'idInscription' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from inscription where id='$idInscription'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_assoc();
    if($danaInBdd["id"] == $idInscription) {
        header('Content-Type: application/json');
        header('idInscription:'. $idInscription);
        print(json_encode($danaInBdd));
    } else {
        print(json_encode("Cette inscription n'existe pas en BDD"));
    }







}

