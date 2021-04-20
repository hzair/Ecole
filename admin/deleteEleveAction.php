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


    $paramObligatoire = null;
    if ($idInscription == null) $paramObligatoire = " $idInscription";
    if ($paramObligatoire != null) {
        //print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        $_SESSION['messageError'] = "les paramettres suivants sont obligatoires : " . $paramObligatoire;
        header('Location: /' . USE_BASE_URL . $err_page);
        exit;
    }

    // requete de suppression
    $deleteEleveSql = "delete from eleve where id ='$idInscription'";

    $result = $mysqli->query($deleteEleveSql); echo ("eeeeee : ".$idInscription);
    if (!$result) {
        $_SESSION['messageError'] = "Erreur de suppression eleve avec le numero " . $idInscription;
        header('Location: /' . USE_BASE_URL . $err_page);
        exit;
    }


    /* Fermeture de la connexion */
    $mysqli->close();


   header('Location: /' . USE_BASE_URL . $success_page);

}

