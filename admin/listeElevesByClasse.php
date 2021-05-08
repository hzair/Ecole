<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php

    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");
    session_start();
 ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LISTE ELEVES </title>

    <link rel="stylesheet" href="../ihm/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../ihm/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../ihm/css/animate.css"/>

    <link rel="stylesheet" href="../ihm/css/style.css" />

    <script type="text/javascript" src="../ihm/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../ihm/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="../ihm/js/plugins.js"></script>

    <!-- Insérer cette balise "link" après celle de Bootstrap -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

    <!-- Insérer cette balise "script" après celle de Bootstrap -->
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/locale/bootstrap-table-fr-FR.min.js"></script>

    <link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
    <script src="extensions/filter-control/bootstrap-table-filter-control.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="application/javascript">
    </script>
</head>
<body>

<?php
if (!isset($_SESSION['ADMIN_IS_CONNECT'])) {
    header("Location: index.php");
}
?>

<script language="JavaScript" type="text/javascript">

    function supprimerEleve(id, nom, dateNaiss){
        if(confirm("Voulez-vous supprimer définitivement l'eléve '" + nom + "' né(e) le '" + dateNaiss +"' ?")) {
            var formElmt = document.getElementById("supp_eleve_form");
            formElmt.idInscription.value = id;
            formElmt.submit();
        }
    }

    function modiferEleve(idFonc, id){
        var formElmt = document.getElementById("modif_inscription_form");
        formElmt.idFoncInscription.value = idFonc;
        formElmt.idInscription.value = id;
        formElmt.submit();
    }

    function deplacerVersInscription(myIdInscription, id, nom, dateNaiss) {
        var newIdInscription = document.getElementById("newIdInscription_" + id);
        if(newIdInscription.value == "-") {
            return;
        }
        if(confirm("Voulez-vous déplacer l'eléve '" + nom + "' né(e) le '" + dateNaiss
                + "' vers l'inscription '" +newIdInscription.value+"' ?")) {
            var formElmt = document.getElementById("deplacer_vers_inscription_form");
            formElmt.idNewInscription.value = newIdInscription.value;
            formElmt.idEleve.value = newIdInscription.value;
            formElmt.submit();
        }
    }


</script>

<form action="deleteEleveAction.php" method="post" id="supp_eleve_form" >
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeElevesFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeElevesFiltre.php">
</form>
<form action="majInscriptionAction.php" method="post" id="modif_inscription_form" >
    <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeElevesFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeElevesFiltre.php">
</form>
<form action="deplacerEleveAction.php" method="post" id="deplacer_vers_inscription_form" >
    <INPUT TYPE="hidden" id="idNewInscription" name="idNewInscription" value="">
    <INPUT TYPE="hidden" id= "idEleve" name="idEleve" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeElevesFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeElevesFiltre.php">
</form>
<table border="1" align="center" style="background-color: #1d1d1d; ">
    <thead>
    <tr>
        <th style="color: white"><a href="listeInscriptionsFiltre.php" style="color: white">&nbsp; &nbsp;La liste des Inscriptions&nbsp; &nbsp;</a></th>
        <th style="color: white"><a href="listeElevesFiltre.php" style="color: white"> &nbsp; &nbsp;La liste des Eleves&nbsp; &nbsp;</a></th>
        <th style="color: white"><a href="listeElevesByClasse.php" style="color: white">&nbsp; &nbsp;La liste des Eleves Par classe &nbsp; &nbsp;</a></th>
        <th style="color: white"><a href="deconnexion.php" style="color: white">&nbsp; &nbsp;Déconnexion&nbsp; &nbsp;</a></th>
    </tr>
    </thead>

</table>

<form class="box" action="" method="post" name="classe">
    <h1 class="box-title">Choisir la classe :

    <select id="numClasseEleve" name="numClasseEleve"  required>
        <option value="" class="backgroundBlackColor" selected>--</option>
        <option value="C 01 - N 2A" class="backgroundBlackColor" >C 01 - N 2A</option>
        <option value="C 04 - N 1B" class="backgroundBlackColor" >C 04 - N 1B</option>
        <option value="C 05 - N 1A" class="backgroundBlackColor" >C 05 - N 1A</option>
        <option value="C 07 - N 2A" class="backgroundBlackColor" >C 07 - N 2A</option>
        <option value="C 08 - N 1B" class="backgroundBlackColor" >C 08 - N 1B</option>
        <option value="C 09 - N 1A" class="backgroundBlackColor" >C 09 - N 1A</option>
        <option value="C 10 - N 2B" class="backgroundBlackColor" >C 10 - N 2B</option>
        <option value="C 11 - N 1A" class="backgroundBlackColor" >C 11 - N 1A</option>
        <option value="C 12 - N 1B" class="backgroundBlackColor" >C 12 - N 1B</option>
        <option value="C 14 - N 1B" class="backgroundBlackColor" >C 14 - N 1B</option>
        <option value="C 15 - N 1A" class="backgroundBlackColor" >C 15 - N 1A</option>
        <option value="C 16 - N 1A" class="backgroundBlackColor" >C 16 - N 1A</option>
        <option value="C 17 - N 3B" class="backgroundBlackColor" >C 17 - N 3B</option>
        <option value="C 18 – N1B S" class="backgroundBlackColor" >C 18 – N1BS</option>
        <option value="C 19 - N 2A" class="backgroundBlackColor" >C 19 - N 2A</option>
        <option value="C 20 - N 1B" class="backgroundBlackColor" >C 20 - N 1B</option>
        <option value="C 21 - N 4A" class="backgroundBlackColor" >C 21 - N 4A</option>
        <option value="C 22 - N 1A" class="backgroundBlackColor" >C 22 - N 1A</option>
        <option value="C 23 - N 2B" class="backgroundBlackColor" >C 23 - N 2B</option>
        <option value="C 24 - N 1B" class="backgroundBlackColor" >C 24 - N 1B</option>
        <option value="C 25 - N 5B" class="backgroundBlackColor" >C 25 - N 5B</option>
        <option value="C 25 bis - N 3B" class="backgroundBlackColor" >C 25 bis - N 3B</option>
        <option value="C 26 - N 2B" class="backgroundBlackColor" >C 26 - N 2B</option>
        <option value="C 27 - N 3B" class="backgroundBlackColor" >C 27 - N 3B</option>
        <option value="C 28 - N 2A" class="backgroundBlackColor" >C 28 - N 2A</option>
        <option value="C 29 - N 1A" class="backgroundBlackColor" >C 29 - N 1A</option>
        <option value="C ADOS F" class="backgroundBlackColor" >C ADOS F</option>
        <option value="C ADOS G1" class="backgroundBlackColor" >C ADOS G1</option>
    </select>

    <input type="submit" value="OK" name="submit" class="box-button">


</form>

</h1>


<?php
if($_POST['numClasseEleve']) {
    $numClassChoisi = $_POST['numClasseEleve'];
} else {
    $numClassChoisi = "rien";
}
?>

<p align="center" class="backgroundTitreColor"> Liste des <span>Elèves</span>
    <?php
        if($_POST['numClasseEleve'])
            echo "de la classe <span>".$_POST['numClasseEleve']."</span>";
        else
            echo "de la classe <span> ...??.... </span>"
    ?>
</p>
        <!--<p>Les champs avec * sont obligatoires </p>-->


<table align="center" border="1" cellpadding="0" cellspacing="1"
       id="table"
       data-toggle="table"
       data-search="true"
       data-filter-control="true"
       data-show-export="true"
       data-click-to-select="true"
       data-toolbar="#toolbar"
       data-pagination="true"
       class="table-responsive">
    <thead>
    <tr>
        <th>Action</th>
        <th data-filter-control="input" data-sortable="true">Nom</th>
        <th data-filter-control="input" data-sortable="true">Prenom</th>
        <!-- <th data-filter-control="input" data-sortable="true">Sexe</th> -->
        <th data-filter-control="input" data-sortable="true">Date Naissance</th>
        <th data-filter-control="input" data-sortable="true">N° Téléphone du père</th>
        <th data-filter-control="input" data-sortable="true">N° Téléphone de la mère</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $findAllInscriptionSql = "SELECT id, id_fonc from inscription";
    $listinscription = $mysqli->query($findAllInscriptionSql) ;
    //$inscriptions = mysqli_fetch_array($listinscription);
    $i = 0;
    while ($inscriptions = mysqli_fetch_array($listinscription)) {
        $inscripTab[$i] = $inscriptions;
        $i++;
    }



    $findAllElevesSql = "SELECT * from eleve where num_annee_prec_ici = '$numClassChoisi' order by ";
    $listEleves = $mysqli->query($findAllElevesSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    if($listEleves) {
        $i = 0;
        while ($eleve = mysqli_fetch_array($listEleves)) {
            $i++;
            $id = $eleve['id'];
            $idInscription = $eleve['id_inscription'];
            $typeCours = $eleve['type_cours'];
            $nom = $eleve['nom'];
            $prenom = $eleve['prenom'];
            $sexe = $eleve['sexe'];
            $dateNaiss = $eleve['date_naissance'];
            $numClass = $eleve['num_annee_prec_ici'];

            // Recuperation Pere
            $findPereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'M'";
            $PereRes = $mysqli->query($findPereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $pere = $PereRes->fetch_array();
            if($pere) {
                $portablePere = $pere['telephone_portable'];
            } else {
                $portablePere = "-";
            }

            // Recuperation Mere
            $findMereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'F'";
            $MereRes = $mysqli->query($findMereSql, MYSQLI_STORE_RESULT_COPY_DATA);
            $mere = $MereRes->fetch_array();
            if ($mere) {
                $portableMere = $mere['telephone_portable'];
            } else {
                $portableMere = "-";
            }

            ?>
                    <tr>
                        <th>     </th>
                        <th> <?php echo($nom);?> </th>
                        <td> <?php echo($prenom);?> </td>
                        <td> <?php echo($sexe);?></td>
                        <td><?php echo($dateNaiss);?> </td>
                        <td><?php echo($portablePere);?></td>
                        <td><?php echo($portableMere);?></td>
                    </tr>
                    <?php

        }
    } else {
        echo ('Erreur de récupération de la liste des inscriptions : ' . $mysqli->error);
    }


    ?>

    </tbody>
</table>

        </div></div></div></div></div></section>

</body></html>