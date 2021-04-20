<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];
    $idInscription = $_POST['idInscription'];
    $idFoncInscription = $_POST['idFoncInscription'];


    $paramObligatoire = null;
    if ($idFoncInscription == null) $paramObligatoire = " idFoncInscription";
    if ($idInscription == null) $paramObligatoire = $paramObligatoire . " $idInscription";
    if ($paramObligatoire != null) {
        //print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        $_SESSION['messageError'] = "les paramettres suivants sont obligatoires : " . $paramObligatoire;
        header('Location: /' . USE_BASE_URL . $err_page);
        exit;
    }

    // requete de suppression
    $deleteInscriptionSql = "delete from inscription where id='$idInscription' and id_fonc='$idFoncInscription'";
    $deleteEleveSql = "delete from eleve where id_inscription='$idInscription'";
    $deleteParentSql = "delete from parent where id_inscription='$idInscription'";

    $result = $mysqli->query($deleteInscriptionSql);
    if ($result) {
        $result2 = $mysqli->query($deleteEleveSql);
        $result3 = $mysqli->query($deleteParentSql);

    } else {

        $_SESSION['messageError'] = "Erreur de creation adulte : l'inscription avec le numero " . $idFoncInscription . "n'existe pas";
        $_SESSION['idFoncInscriptionInconnu'] = "l'identifiant " . $idFoncInscription . " est inconnu";
        header('Location: /' . USE_BASE_URL . $err_page);
        exit;
    }


    /* Fermeture de la connexion */
    $mysqli->close();


    header('Location: /' . USE_BASE_URL . $success_page);

}

