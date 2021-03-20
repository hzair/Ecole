<p align="center"> FICHE D’ENGAGEMENT ET DE PAIEMENT </p>
<p align="center"> 2021-2022 </p>

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(dirname(__FILE__) . "/../service/conf/Config.php");
    require_once(dirname(__FILE__) . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];
    $idInscription = $_POST['idInscription'];
    $idFoncInscription = $_POST['idFoncInscription'];

    // Recuperation Pere
    $findPereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'M'";
    $PereRes = $mysqli->query($findPereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    $pere = $PereRes->fetch_array();
    if($pere) {
        $nomPere = $pere['nom'];
        $prenomPere = $pere['prenom'];
        $emailPere = $pere['email'];
        $portablePere = $pere['telephone_portable'];
        $coursArabeAdultePere = $pere['cours_arabe_adulte'];
        $coursScienceIslamiquePere = $pere['cours_sciences_islamiques'];
    }
?>
    Nom de famille : <?php echo(" ".$nomPere);?>       Téléphone : <?php echo(" ".$portablePere);?>
    Adresse mail   : <?php echo(" ".$emailPere);?>

    <br/><br>

    L’inscription à l’institut espoir vaut mon engagement pour une scolarité pendant une année
    complète ; Je m’engage à payer régulièrement selon les échéances fixées les frais de
    scolarité de mon ou mes enfant(s) ; Si on désire retirer son enfant après le commencement des
    cours, aucun remboursement ne sera effectué quelque soit la raison, l’année scolaire sera dû. En
    cas de confinement, je m’engage à poursuivre les cours à distance et de continuer à régler
    mes mensualités.

    <br/> <br/>

    Cours des enfants :
<?php
    // Recuperation Mere
    $findMereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'F'";
    $MereRes = $mysqli->query($findMereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    $mere = $MereRes->fetch_array();
    if($mere) {
        $nomMere = $mere['nom'];
        $prenomMere = $mere['prenom'];
        $portableMere = $mere['telephone_portable'];
        $coursArabeAdulteMere = $mere['cours_arabe_adulte'];
        $coursScienceIslamiqueMere = $mere['cours_sciences_islamiques'];
    }

    // Recuperation liste Enfants
    $findEnfantsSql = "SELECT * FROM eleve where id_inscription = '$idInscription'";
    $EleveRes = $mysqli->query($findEnfantsSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

    if($EleveRes) {
        $nbrEleve = 0;
        while ($eleve = $EleveRes->fetch_array()) {
            $nomEleve = $eleve['nom'];
            $prenomEleve = $eleve['prenom'];
            $sexeEleve = $eleve['sexe'];
            $dateNaissance = $eleve['date_naissance'];
?>
            <br/>
            NOM Prénom : <?php echo(' '.$nomEleve.' '.$prenomEleve); ?>  Né<?php if ($sexeEleve == "F") echo("e"); ?>  le <?php echo(' '.$dateNaissance); ?>
<?php
            $nbrEleve++;
        }
    }
?>
    <br/><br/>
    Cours arabe adulte :
        <br>
        NOM Prénom : <?php
                        if($coursArabeAdultePere) echo(" ".$nomPere." ".$prenomPere); else echo(" / ");
                      ?>
        <br/>
        NOM Prénom : <?php
                        if($coursArabeAdulteMere) echo(" ".$nomMere." ".$prenomMere); else echo(" / ");
                     ?>
    <br/><br/>
    Cours sciences islamiques :
        <br/>
        NOM Prénom : <?php
                        if($coursScienceIslamiquePere) echo(" ".$nomPere." ".$prenomPere); else echo(" / ");
                     ?>
        <br/>
        NOM Prénom : <?php
                        if($coursScienceIslamiqueMere) echo(" ".$nomMere." ".$prenomMere); else echo(" / ");
                     ?>

    <br/><br/>


<p align="center">MODALITES DU PAIEMENT</p>





<?php
}

?>


<p align="center">
    <a href="javascript:window.print()">Imprimer</a>   &nbsp; &nbsp; &nbsp;
    <!--<a href="javascript:self.close('Imprimer la commande');">Fermer</a>-->
</p>