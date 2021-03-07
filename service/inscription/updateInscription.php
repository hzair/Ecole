<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idInscription = $_POST['idInscription'];
    $parentsSepare = $_POST['parentsSepare'];
    $idPere = $_POST['idPere'];
    $idMere = $_POST['idMere'];
    $email = $_POST['email'];

    if($idInscription == null){
        print(json_encode("le paramètre 'idInscription' est obligatoire"));
        return;
    }
    if($email == null){
        print(json_encode("le paramètre 'email' est obligatoire"));
        return;
    }
    if($idPere == null && $idMere == null){
        print(json_encode("Au moins un des deux paramètres est obligatoire : 'idPere' et/ou 'idMere'"));
        return;
    }
    if($parentsSepare == null){
        print(json_encode("le paramètre 'parentsSepare' est obligatoire"));
        return;
    }

    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from inscription where id='$idInscription'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_array();
    if($danaInBdd["id"] == $idInscription) {
        if($parentsSepare == null) {
            $parentsSepare = $danaInBdd["parents_separe"];
        }
        if($idMere == null) {
            $idMere = $danaInBdd["id_mere"];
        }
        if($idPere == null) {
            $idPere = $danaInBdd["id_pere"];
        }

        $sql = "UPDATE inscription SET email='$email', id_pere='$idPere', id_mere='$idMere', parents_separe= '$parentsSepare' WHERE id=$idInscription";

        $result = $mysqli->query($sql);
        if ($result) {
            print(json_encode($idInscription));
        } else {
            print(json_encode("erreur de creation inscription"));
        }
    } else {
        print(json_encode("Cette inscription n'existe pas en BDD"));
    }

    /* Fermeture de la connexion */
    $mysqli->close();






}

