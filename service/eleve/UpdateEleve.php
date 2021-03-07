<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idEleve = $_POST['idEleve'];
    if ($idEleve == null){
        print(json_encode("le paramettre suivant est obligatoire : idEleve"));
        return;
    }

    $idInscription = $_POST['idInscription'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance']; // format : yyyy-mm-jj
    $lieuNaissance = $_POST['lieuNaissance'];
    $sexe = $_POST['sexe'];
    $coursAnneePrec = $_POST['coursAnneePrec'];
    $coursAnneePrecIci = $_POST['coursAnneePrecIci'];
    $numAnneePrecIci = $_POST['numAnneePrecIci'];
    $autorisationPhoto = $_POST['autorisationPhoto'];
    $decharge = $_POST['decharge'];

    // Verifier si Eleve existe en BDD
    $findSql="select * from eleve where id='$idEleve'";
    $result2 = $mysqli->query($findSql);
    $dataInBdd = $result2->fetch_array();
    if($dataInBdd["id"] == $idEleve) {

        $paramObligatoire = null;
        //if ($idInscription == null) $idInscription = $dataInBdd["id_inscription"];
        if ($nom == null) $nom = $dataInBdd["nom"];
        if ($prenom == null) $prenom = $dataInBdd["prenom"];
        if ($dateNaissance == null) $dateNaissance = $dataInBdd["date_naissance"];
        if ($lieuNaissance == null) $lieuNaissance = $dataInBdd["lieu_naissance"];
        if ($sexe == null) $sexe = $dataInBdd["sexe"];
        if ($coursAnneePrec == null) $coursAnneePrec = $dataInBdd["cours_annee_prec"];
        if ($coursAnneePrecIci == null) $coursAnneePrecIci = $dataInBdd["cours_annee_prec_ici"];
        if ($numAnneePrecIci == null) $numAnneePrecIci = $dataInBdd["num_annee_prec_ici"];
        if ($autorisationPhoto == null) $autorisationPhoto = $dataInBdd["autorisation_photo"];
        if ($decharge == null) $decharge = $dataInBdd["decharge"];

        $sql = "UPDATE eleve SET nom='$nom', prenom='$prenom', date_naissance='$dateNaissance', lieu_naissance='$lieuNaissance', 
                sexe='$sexe', cours_annee_prec='$coursAnneePrec', num_annee_prec_ici='$numAnneePrecIci', 
                cours_annee_prec_ici='$coursAnneePrecIci', autorisation_photo='$autorisationPhoto', decharge='$decharge'
                WHERE id=$idEleve";

        $result = $mysqli->query($sql, MYSQLI_STORE_RESULT_COPY_DATA);
        if ($result) {
            print(json_encode($result));
        } else {
            print(json_encode("Erreur de mise a jour eleve : " . $mysqli->error));
        }

    } else {
        print(json_encode("Erreur de mise a jour : l'eleve avec ID=".$idEleve." n'existe pas" ));
    }

    /* Fermeture de la connexion */
    $mysqli->close();



}

