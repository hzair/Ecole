<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];
    $idFoncInscription = $_POST['idFoncInscription'];
    $idInscription= $_POST['idInscription'];
    $idEleve = $_POST['idEleve'];

    // Eleve :
    $nom = $_POST['nomEleve'];
    $prenom = $_POST['prenomEleve'];
    $dateNaissance = $_POST['dateNaissEleve']; // format : yyyy-mm-jj
    $lieuNaissance = $_POST['lieuNaissEleve'];
    $sexe = $_POST['sexeEleve'];
    $coursAnneePrec = $_POST['suiviCourEleve'];
    $coursAnneePrecIci = $_POST['suiviCourIciEleve'];
    $numAnneePrecIci = $_POST['numClasseEleve'];
    $autorisationPhoto = $_POST['photographieEleve'];
    $decharge = $_POST['dechargeEleve'];
    $newIdFoncInscription = $_POST['newIdFoncInscription'];


    // Modification de l'Eleve en BDD
    $sql = "update `eleve` set `nom`='$nom', `prenom`='$prenom', `date_naissance`='$dateNaissance', `lieu_naissance`='$lieuNaissance',
                   `sexe`='$sexe', `cours_annee_prec`='$coursAnneePrec', `cours_annee_prec_ici`='$coursAnneePrecIci',
                   `num_annee_prec_ici`='$numAnneePrecIci', `autorisation_photo`='$autorisationPhoto', `decharge`='$decharge'                   
                   where `id` = '$idEleve'";

    $result = $mysqli->query($sql) ;


    if($newIdFoncInscription != $idFoncInscription) {
        $sql2 = "update `eleve` set `id_inscription`= (select id from inscription where `id_fonc` = '$newIdFoncInscription') 
                    where `id` = '$idEleve'";
        $result = $mysqli->query($sql2) ;
    }


    // Redirection de la page
    header('Location: /'. USE_BASE_URL . $success_page);



    /* Fermeture de la connexion */
    $mysqli->close();
} else {
    print(json_encode("ERREUR : post action "));
    exit;
}

