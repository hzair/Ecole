<html lang="en" xmlns="http://www.w3.org/1999/html">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(dirname(__FILE__) . "/../service/conf/Config.php");
    require_once(dirname(__FILE__) . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FICHE D’ENGAGEMENT ET DE PAIEMENT</title>

    <link rel="stylesheet" href="../ihm/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../ihm/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../ihm/css/animate.css"/>

    <link rel="stylesheet" href="../ihm/css/style.css" />

    <script type="text/javascript" src="../ihm/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../ihm/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="../ihm/js/plugins.js"></script>


    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="application/javascript">

        function integOuEchelon(elm) {
            if(elm.value == "echlonne"){
                document.getElementById('especeOuCB').disabled = true;
                document.getElementById('especeOuCB').style.display = "none";

                document.getElementById('paiementEchelonneId').disabled = false;
                document.getElementById('paiementEchelonneId').style.display = "";

                document.getElementById('preleveEchelonne').disabled = false;
                document.getElementById('preleveEchelonne').style.display = "";

                document.getElementById('preleveDate').disabled = false;
                document.getElementById('preleveDate').style.display = "";
            } else {
                document.getElementById('especeOuCB').disabled = false;
                document.getElementById('especeOuCB').style.display = "";

                document.getElementById('paiementEchelonneId').disabled = true;
                document.getElementById('paiementEchelonneId').style.display = "none";

                document.getElementById('preleveEchelonne').disabled = true;
                document.getElementById('preleveEchelonne').style.display = "none";

                document.getElementById('preleveDate').disabled = true;
                document.getElementById('preleveDate').style.display = "none";
            }

        }

        function verifyAndPrint() {
            var message = "Avant d'imprimer, il faut selectionner : ";
            var imprime = true;

            if(document.getElementById('integOuEchelon').value == "--") {
                message = message + " \n - Le type de payement (integral ou échelonné)";
                imprime = false;
            }
            if(document.getElementById('especeOuCB').value == "--"
                && document.getElementById('especeOuCB').disabled == false) {
                message = message + " \n - Le mode de payement (espece ou CB)";
                imprime = false;
            }
            if(document.getElementById('preleveEchelonne').value == "--"
                && document.getElementById('preleveEchelonne').disabled == false) {
                message = message + " \n - Le nombre de prélèvement";
                imprime = false;
            }
            if(document.getElementById('preleveDate').value == "--"
                && document.getElementById('preleveDate').disabled == false) {
                message = message + " \n - La date de prélèvement";
                imprime = false;
            };
            if(imprime) {
                document.getElementById('imprimeBouton').style.display = "none";
                window.print();
            } else {
                alert(message);
            }
        }
    </script>
</head>
<body>

<p align="center"><img align="center" src="../ihm/images/institut-espoire.png"></p>

<p align="center" class="backgroundTitreColor"> FICHE D’ENGAGEMENT ET DE PAIEMENT </p>
<p align="center" class="backgroundAnneeColor"> 2021-2022 </p>

<?php

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
        <br/>
    <p style="border: solid">
        <table align="center" border="0" cellpadding="0" cellspacing="1">
            <body>

            <tr>
                <th width="180" align="right" valign="middle" >&nbsp; Nom de famille :</th>
                <td width="200" valign="middle" style="color: #0b1e8d">&nbsp; <b><?php echo($nomPere);?></b></td>
                <th width="180" align="right" valign="middle" >&nbsp; Id. Inscription :</th>
                <td width="200" valign="middle" style="color: #0b1e8d">&nbsp;<b><?php echo($idFoncInscription);?></b></td>
            </tr>
            <tr>
                <th align="right" valign="middle">&nbsp; Téléphone :</th>
                <td valign="middle" style="color: #0b1e8d">&nbsp; <b><?php echo($portablePere);?></b></td>
                <th align="right" valign="middle">&nbsp; Adresse mail :</th>
                <td valign="middle" style="color: #0b1e8d">&nbsp; <b><?php echo($emailPere);?></b> </td>
            </tr>
            </body>
        </table>
    </p>


    <p align="justify" >
        L’inscription à l’institut espoir vaut mon engagement pour une scolarité pendant une année
        complète ; Je m’engage à payer régulièrement selon les échéances fixées les frais de
        scolarité de mon ou mes enfant(s) ; Si on désire retirer son enfant après le commencement des
        cours, aucun remboursement ne sera effectué quelque soit la raison, l’année scolaire sera dû. En
        cas de confinement, je m’engage à poursuivre les cours à distance et de continuer à régler
        mes mensualités.
    </p>

    <p align="left" class="backgroundTitre2Color"> COURS DES ENFANTS</p>

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
    $findEnfantsSql = "SELECT * FROM eleve where id_inscription = '$idInscription'  and type_cours='ENF'";
    $EleveRes = $mysqli->query($findEnfantsSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

    if($EleveRes) {
        $nbrEleve = 0;
 ?>
        <table border="0" cellspacing=4 cellpadding=4> <tr>
 <?php
        while ($eleve = $EleveRes->fetch_array()) {
            $nomEleve = $eleve['nom'];
            $prenomEleve = $eleve['prenom'];
            $sexeEleve = $eleve['sexe'];
            $dateNaissance = $eleve['date_naissance'];
?>
                <td align="center" valign="middle">
            <p align="center" style="border: solid" >
                <?php echo(' '.$nomEleve.' '.$prenomEleve); ?> <br/>
                Né<?php if ($sexeEleve == "F") echo("e"); ?>  le <?php echo(' '.$dateNaissance); ?>
            </p>
                </td>
            <td align="center" valign="middle"> &nbsp;</td>
<?php
            $nbrEleve++;
        }
?>
            </tr></table>
<?php    }
?>
    <br/>

<p align="left" class="backgroundTitre2Color"> COURS ARABE POUR ADULTE </p>
<?php
$findAdultSql = "SELECT * FROM eleve where id_inscription = '$idInscription' and type_cours='ARABE'";
$EleveAdultRes = $mysqli->query($findAdultSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

if($EleveAdultRes) {
$nbrEleve = 0;
?>
<table border="0" cellspacing=4 cellpadding=4> <tr>
        <?php
        while ($eleve = $EleveAdultRes->fetch_array()) {
            $nomEleve = $eleve['nom'];
            $prenomEleve = $eleve['prenom'];
            $sexeEleve = $eleve['sexe'];
            $dateNaissance = $eleve['date_naissance'];
            ?>
            <td align="center" valign="middle">
                <p align="center" style="border: solid" >
                    <?php echo(' '.$nomEleve.' '.$prenomEleve); ?> <br/>
                    Né<?php if ($sexeEleve == "F") echo("e"); ?>  le <?php echo(' '.$dateNaissance); ?>
                </p>
            </td>
            <td align="center" valign="middle"> &nbsp;</td>
            <?php
            $nbrEleve++;
        }
        ?>
    </tr></table>
<?php    }
?>

<p align="left" class="backgroundTitre2Color"> COURS SCIENCES ISLAMIQUE </p>
<?php
$findAdultSql = "SELECT * FROM eleve where id_inscription = '$idInscription' and type_cours='SCIENCES_ISLAMIQUES'";
$EleveAdultRes = $mysqli->query($findAdultSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

if($EleveAdultRes) {
    $nbrEleve = 0;
    ?>
    <table border="0" cellspacing=4 cellpadding=4> <tr>
            <?php
            while ($eleve = $EleveAdultRes->fetch_array()) {
                $nomEleve = $eleve['nom'];
                $prenomEleve = $eleve['prenom'];
                $sexeEleve = $eleve['sexe'];
                $dateNaissance = $eleve['date_naissance'];
                ?>
                <td align="center" valign="middle">
                    <p align="center" style="border: solid" >
                        <?php echo(' '.$nomEleve.' '.$prenomEleve); ?> <br/>
                        Né<?php if ($sexeEleve == "F") echo("e"); ?>  le <?php echo(' '.$dateNaissance); ?>
                    </p>
                </td>
                <td align="center" valign="middle"> &nbsp;</td>
                <?php
                $nbrEleve++;
            }
            ?>
        </tr></table>
<?php    }
?>


    <br/>

    <p align="center" class="backgroundTitre2Color"> MODALITES DU PAIEMENT</p>

    <ul>
        <li><b> PAIEMENT <select id="integOuEchelon" name="integOuEchelon" onchange="integOuEchelon(this)">
                    <option value="--" selected>........</option>
                    <option value="integral">INTEGRAL</option>
                    <option value="echlonne">ECHELONNE</option>
                </select> </b> :

            <b><select id="especeOuCB" name="especeOuCB" required>
                <option value="--" selected>.......</option>
                <option value="espece">Espèce</option>
                <option value="CB">CB (Carte Boncaire)</option>
                </select></b>

        </li>
        <ul id="paiementEchelonneId">
                <li>
                        40€ par élève : immédiatement par tout moyen (lors de la remise du mandat de
                        prélèvement).
                </li>
                <li>le mentant restant : &nbsp; est prélevé en
                    <b><select id="preleveEchelonne" name="preleveEchelonne" required>
                        <option value="--" selected>.....</option>
                        <option value="4">04</option>
                        <option value="8">08</option>
                        </select> </b>  fois </li>
                <p align="justify">
                    A compter du mois d’octobre, et sous réserve de reprise des cours, un prélèvement automatique
                    mensuel sera planifié, un mandat de prélèvement SEPA doit être rempli et signé accompagné de la copie de la
                    pièce d’identité du titulaire du compte le jour de l’inscription.
                </p>
                <p align="justify">
                    Un prélèvement rejeté engendre 20€ de frais qui feront l’objet d’un prélèvement le mois suivant.
                </p>
                <p align="justify">
                    Sous réserve de reprise effective des cours, le prélèvement mensuel sera planifié à compter du mois d’octobre
                    2021 : <b><select id="preleveDate" name="preleveDate" required>
                        <option value="--" selected>..............</option>
                        <option value="6">Le 06 du mois</option>
                        <option value="16">Le 16 du mois</option>
                        <option value="26">Le 26 du mois</option>
                        </select></b>
                </p>
            </ul>
    </ul>

    <p align="justify">

    </p>

    <b>Je déclare avoir pris connaissance des conditions de réinscription et du règlement ainsi que les
        modalités qui me sont proposées.</b>


    <br/>

    <br/>

Fait à  <b><input type="text" name="ville" rows="1" value="BRON"></b>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Le <b><input type="text" name="date" rows="1" value="<?php echo(date('d F Y'));?>"> </b>

    <p align="center">
        Signature précédée de la mention « Lu et approuvée »
    </p>
    <p align="right" >

    </p>

    <p id="imprimeBouton" align="center">
        <button id="imprimeBouton" onclick="verifyAndPrint()">imprimer</button>
    </p>


</body>

<?php
} //$_SERVER['REQUEST_METHOD'] == 'POST'

?>

</html>