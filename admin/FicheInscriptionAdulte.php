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
    $idEleve = $_GET['idAdulte'];

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FICHE INSCRIPTION</title>

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
    $findPereSql = "SELECT * FROM parent where id = '$idEleve' ";
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
?>

<p align="center" class="backgroundTitreColor"> FICHE D’INSCRIPTION</p>

<p align="center" class="backgroundTitreColor">
<?php
if($coursArabeAdultePere && $coursScienceIslamiquePere) {
    echo('Cours Arabe Adulte + Cours Sciences Islamique');
} else {
    if($coursArabeAdultePere) {
        echo('Cours Arabe Adulte');
    }
    if($coursScienceIslamiquePere){
        echo('Cours Sciences Islamique');
    }
}
?>
</p>
?>
<p align="center" class="backgroundAnneeColor"> 2021-2022 </p>

<br/>
<br/>

<p align="left" class="backgroundTitre2Color"> INFORMATIONS DES PARENTS</p>


    <p style="border: solid">
        <table align="center" border="0" cellpadding="0" cellspacing="1">
            <body>

            <tr>
                <th width="100" align="right" valign="middle" > Personne : </th>
                <td width="250" valign="middle" style="color: #0b1e8d"> <b> <?php echo($nomPere . " ". $prenomPere);?></b></td>
                <th width="120" align="right" valign="middle" > Profess. :</th>
                <td width="250" valign="middle" style="color: #0b1e8d"><b><?php echo($professionPere);?></b></td>
                <th width="160" align="right" valign="middle" > Tel. Portable :</th>
                <td width="200" valign="middle" style="color: #0b1e8d"><b><?php echo($portablePere);?></b></td>
            </tr>
            <tr>
                <td valign="center" style="color: #0b1e8d">-----------</td>
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
            </tr>
            <tr>
                <td valign="center" style="color: #0b1e8d">---------</td>
                <td valign="center" style="color: #0b1e8d">&nbsp;</td>
                <td valign="center" style="color: #0b1e8d">----------</td>
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