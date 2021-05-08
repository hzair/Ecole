<html lang="en" xmlns="http://www.w3.org/1999/html">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once(dirname(__FILE__) . "/../service/conf/Config.php");
    require_once(dirname(__FILE__) . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();
?>
    <?php
    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

//$success_page = $_GET['returnPage'];
//$err_page = $_GET['returnErrorPage'];
    $idInscription = $_GET['idInscription'];
    $idEleve = $_GET['idEleve'];

// Recuperation Eleve
    $findEnfantsSql = "SELECT * FROM eleve where id = '$idEleve'";
    $EleveRes = $mysqli->query($findEnfantsSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

    if($EleveRes) {
        $eleve = $EleveRes->fetch_array();
        ?>
        <?php
        $idInscription = $eleve['id_inscription'];
        $nomEleve = $eleve['nom'];
        $prenomEleve = $eleve['prenom'];
        $sexeEleve = "Une fille";
        if($eleve['sexe'] == "M") {
            $sexeEleve = "Un garçon";
        }
        $dateNaissanceEl = $eleve['date_naissance'];
        $lieuNaissEl = $eleve['lieu_naissance'];
        $suivCoursArab = "Non";
        if($eleve['cours_annee_prec']) {
            $suivCoursArab = "Oui";
        }
        $chezNous = "Non";
        if($eleve['cours_annee_prec_ici']) {
            $chezNous = "Oui";
        }
        $numClass = "";
        if($eleve['cours_annee_prec_ici']) {
            $numClass = $eleve['num_annee_prec_ici'];
        }

        $decharge = "Non";
        if($eleve['decharge']) {
            $decharge = "Oui";
        }
        $photograph = "Non";
        if($eleve['autorisation_photo']) {
            $photograph = "Oui";
        }

        $typeCours =  getTypeCours($eleve['type_cours']);
        ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FICHE - <?php echo($prenomEleve ." - ".$typeCours); ?></title>

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

                document.getElementById('imprimeBouton').style.display = "none";
                window.print();

        }
    </script>
</head>
<body>

<p align="center"><img align="center" src="../ihm/images/institut-espoir.png"></p>

<br/>




<p align="center" class="backgroundTitreColor"> FICHE D’INSCRIPTION <?php echo($typeCours);?> </p>
<p align="center" class="backgroundAnneeColor"> 2021-2022 </p>


<p align="left" class="backgroundTitre2Color"> INFORMATIONS DES PARENTS</p>
<?php

    // Recuperation Inscription
    $findInscSql = "SELECT * FROM inscription where id = '$idInscription'";
    $InscrRes = $mysqli->query($findInscSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    $inscription = $InscrRes->fetch_array();
    if($inscription) {
        $parentSepar = "non";
        if($inscription['parents_separe']) {
            $parentSepar = "oui";
        }
    }

    // Recuperation Pere
    $findPereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'M'";
    $PereRes = $mysqli->query($findPereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    $pere = $PereRes->fetch_array();
    if($pere) {
        $nomPere = $pere['nom'];
        $prenomPere = $pere['prenom'];
        $emailPere = $pere['email'];
        $portablePere = $pere['telephone_portable'];
        $telFixe = $pere['telephone_fixe'];
        $professionPere = $pere['profession'];
        $coursArabeAdultePere = $pere['cours_arabe_adulte'];
        $coursScienceIslamiquePere = $pere['cours_sciences_islamiques'];
        $adresse = $pere['adresse'] ." ". $pere["code_postale"] ." ". $pere["ville"];
    }

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
        $professionMere = $mere['profession'];
    }
?>
    <p style="border: solid">
        <table align="center" border="0" cellpadding="0" cellspacing="1">
            <body>

            <tr>
                <th width="100" align="right" valign="middle" > Père  : </th>
                <td width="250" valign="middle" style="color: #0b1e8d"> <b> <?php echo($nomPere . " ". $prenomPere);?></b></td>
                <th width="120" align="right" valign="middle" > Profess. :</th>
                <td width="250" valign="middle" style="color: #0b1e8d"><b><?php echo($professionPere);?></b></td>
                <th width="160" align="right" valign="middle" > Tel. Portable :</th>
                <td width="200" valign="middle" style="color: #0b1e8d"><b><?php echo($portablePere);?></b></td>
            </tr>
            <tr>
                <td valign="center" style="color: #0b1e8d">-------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                <td valign="center" style="color: #0b1e8d">-------------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp; </td>
                <td valign="center" style="color: #0b1e8d">----------------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp; </td>
            </tr>
            <tr>
                <th align="right" valign="middle" > Mère : </th>
                <td valign="middle" style="color: #0b1e8d"> <b> <?php echo($nomMere . " ". $prenomMere);?></b></td>
                <th align="right" valign="middle" > Profession :</th>
                <td valign="middle" style="color: #0b1e8d"><b><?php echo($professionMere);?></b></td>
                <th align="right" valign="middle" > Tel. Portable :</th>
                <td valign="middle" style="color: #0b1e8d"><b><?php echo($portableMere);?></b></td>
            </tr>
            <tr>
                <td valign="center" style="color: #0b1e8d">-------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                <td valign="center" style="color: #0b1e8d">-------------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp; </td>
                <td valign="center" style="color: #0b1e8d">----------------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp; </td>
            </tr>
            <tr>
                <th align="right" valign="middle"> E-mail  :</th>
                <td valign="middle" style="color: #0b1e8d"> <b><?php echo($emailPere);?></b></td>
                <th align="right" valign="middle"> Tel. fixe :</th>
                <td valign="middle" style="color: #0b1e8d"> <b><?php echo($telFixe);?></b> </td>
                <th align="right" valign="middle"> Parents séparés :</th>
                <td valign="middle" style="color: #0b1e8d"><b><?php echo($parentSepar);?></b></td>
            </tr>
            <tr>
                <td valign="center" style="color: #0b1e8d">---------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                <td valign="center" style="color: #0b1e8d">----------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp; </td>
                <td valign="center" style="color: #0b1e8d">-------------------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp; </td>
            </tr>
            <tr>
                <th align="right" valign="middle"> Adresse :</th>
                <td valign="middle" style="color: #0b1e8d" colspan="5"> <b><?php echo($adresse);?></b></td>

            </tr>
            </body>
        </table>
    </p>

<br/>

    <p align="left" class="backgroundTitre2Color"> INFORMATIONS DE L'ELEVE</p>



                <p style="border: solid">
                <table align="center" border="0" cellpadding="0" cellspacing="1">
                    <body>

                    <tr>
                        <th width="100" align="right" valign="middle" > Elève  : </th>
                        <td width="250" valign="middle" style="color: #0b1e8d"> <b> <?php echo($nomEleve . " ". $prenomEleve);?></b></td>
                        <th width="80" align="right" valign="middle" > Sexe :</th>
                        <td width="120" valign="middle" style="color: #0b1e8d"><b><?php echo($sexeEleve);?></b></td>
                        <th width="250" align="right" valign="middle" > Date et lieu de naissance :</th>
                        <td width="200" valign="middle" style="color: #0b1e8d"><b><?php echo($dateNaissanceEl . " à ". $lieuNaissEl);?></b></td>
                    </tr>
                    <tr>
                        <td valign="center" style="color: #0b1e8d"> -------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                        <td valign="center" style="color: #0b1e8d"> ------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp; </td>
                        <td valign="center" style="color: #0b1e8d"> -----------------------------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp; </td>
                    </tr>
                    <?php
                      if($eleve['type_cours'] == "ENF") {
                    ?>

                    <tr>
                        <th align="right" valign="middle" colspan="3" > L'élève a déjà suivi des cours d'arabe : </th>
                        <td valign="middle" style="color: #0b1e8d"> <b> <?php echo($suivCoursArab);?></b></td>
                    </tr>
                    <tr>
                        <td valign="center" style="color: #0b1e8d" colspan="3"> -------------------------------------------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="right" valign="middle" colspan="3"> Au sein de notre école durant 2020/2021 :</th>
                        <td valign="middle" style="color: #0b1e8d"><b><?php echo($chezNous);?></b></td>
                        <th align="right" valign="middle" > N° de Classe :</th>
                        <td valign="middle" style="color: #0b1e8d"><b><?php echo($numClass);?></b></td>
                    </tr>
                    <tr>
                        <td valign="center" style="color: #0b1e8d" colspan="3"> ---------------------------------------------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                        <td valign="center" style="color: #0b1e8d"> --------------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp; </td>
                    </tr>
                    <tr>
                        <th align="right" valign="middle" colspan="3">&nbsp;   <?php if($eleve['sexe'] == "M") {
                                echo("J’autorise mon fils à renter seul à la maison :");
                            } else {
                                echo("J’autorise ma fille à renter seule à la maison :");
                            }?>
                         </th>
                        <td valign="middle" style="color: #0b1e8d"> <b><?php echo($decharge);?></b></td>
                    </tr>
                    <tr>
                        <td valign="center" style="color: #0b1e8d" colspan="3"> --------------------------------------------------</td>
                        <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="right" valign="middle" colspan="3"> Autorisation de photographie :</th>
                        <td valign="middle" style="color: #0b1e8d"> <b><?php echo($photograph);?></b> </td>

                    </tr>
                    <?php
                    }
                    ?>

                    </body>
                </table>
                </p>


<?php    }
?>


    <br/>



    <b>Je déclare avoir pris connaissance des conditions d'inscription ci-joint ainsi que les
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


function getTypeCours($key) {
    if($key == 'ENF') {
        return 'au cours Arabe pour Enfant';
    }
    if($key == 'ARABE') {
        return 'au cours Arabe pour adulte';
    }
    if($key == 'SCIENCES_ISLAMIQUES') {
        return 'au cours Sciences islamiques';
    }
    return 'inconnu';
}

?>

</html>