<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . "/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("/datasource/connectToBdd.php");

    session_start();

    unset($_SESSION['idInscription']);
    unset($_SESSION['idFoncInscription']);

    $success_page = $_POST['returnPage'];
    header('Location: /'. USE_BASE_URL . $success_page);
    unset($_SESSION['messageError']);

}

