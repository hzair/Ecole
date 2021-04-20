<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . "/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("datasource/connectToBdd.php");

    session_start();
    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);


    $success_page = $_POST['returnPage'];
    $error_page = $_POST['returnErrorPage'];

    $idFoncInscription = $_POST['idFoncInscription'];

    if ($idFoncInscription == null) {
        $_SESSION['messageError'] = "Cette identifiant est obligatoire";
        header('Location: /'. USE_BASE_URL . $error_page);
        exit;
    }

    $findSql="select * from inscription where id_fonc='$idFoncInscription'";
    $result = $mysqli->query($findSql);
    $dataInBdd = $result->fetch_array();
    if($dataInBdd["id"] == null) {
        $_SESSION['messageError'] = "Cet identifiant est inconnu";
        header('Location: /'. USE_BASE_URL . $error_page);
        exit;
    }
    unset($_SESSION['messageError']);
    $_SESSION['idFoncInscription'] = $dataInBdd["id_fonc"];
    $_SESSION['idInscription'] = $dataInBdd["id"];
    header('Location: /'. USE_BASE_URL . $success_page);

}

