<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idEleve = $_GET['idEleve'];

    if($idEleve == null){
        print(json_encode("le paramètre 'idEleve' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from eleve where id='$idEleve'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_assoc();
    if($danaInBdd["id"] == $idEleve) {
        header('Content-Type: application/json');
        header('idEleve:'. $idEleve);
        print(json_encode($danaInBdd));
    } else {
        print(json_encode("Cette eleve avec ID=".$idEleve." n'existe pas en BDD"));
    }







}

