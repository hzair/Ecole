<!DOCTYPE html>

<?php
require_once(__DIR__ . "/../service/conf/Config.php");
require_once(__DIR__ . "/../utils/fonctions.php");
include("../service/datasource/connectToBdd.php");
session_start();

$success_page = $_POST['returnPage'];
$err_page = $_POST['returnErrorPage'];
$idFoncInscription = $_POST['idFoncInscription'];
$idInscription = $_POST['idInscription'];
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
	<head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Inscriptions - Modification Compte</title>

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



            function checkInputForm() {
                // 1 - verifier que nbrEnfants est un nombre
                var email = document.forms["inscription"]["email"].value;
                var _at = email.search("@");
                var _dot = 	email.search(".");
                if(_at=="-1" || _dot=="-1"){
                    alert("Le format Email est non valide. (Ex: monEmail@nomDomaine.xx)");
                    return false;
                }
            }

            function activeElemnt(name1, name2) {
                $(document).ready(function(){
                    $(select[name=name1]).on('change',function(){
                        if($(this).val()==1){
                            $("input[name=name2]").prop("disabled",false);
                        }else{
                            $("input[name=name2]").prop("disabled",true);
                        }
                    });
                });


            }

            function togg(_this){
                let d1 = document.getElementById("conditionIframe");
                if(getComputedStyle(d1).display != "none"){
                    _this.value = "afficher";
                    d1.style.display = "none";
                } else {
                    _this.value = "masquer";
                    d1.style.display = "block";
                }
            };

        </script>

	</head>
	<body>




        <!--  ============== DEBUT - CONTENT PRINCIPAL DE LA PAGE ==================== -->
        <div class="container-fluid">

            <!-- HEADER -->
            <section id="">


                <!-- SLIDER -->
                <div class="header-slide">


                    <script type="text/javascript">
                        var dataHeader = [
                                {
                                    bigImage :"images/slide-2.jpg",
                                    title : "Inscription 2021-2022"
                                },
                                {
                                    bigImage :"images/institut-espoir.png",
                                    title : "Institut Espoir"
                                }
                            ],
                            loaderSVG = new SVGLoader(document.getElementById('loader'), {speedIn : 800, speedOut : 800, easingIn : mina.easeinout});
                        //loaderSVG.show()
                    </script>

                </div><!-- /.header-slide -->
            </section>
            <!-- HEADER END -->

        <?php

            $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

            // Recuperation inscription
            $findInscriptionSql = "SELECT * FROM inscription where id = '$idInscription'";
            $inscriptionRes = $mysqli->query($findInscriptionSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $inscription = $inscriptionRes->fetch_array();
            if($inscription) {
                $parentsSepare = $inscription['parents_separe'];
            } else {
                $parentsSepare = "";
            }

            // Recuperation Pere
            $findPereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'M'";
            $PereRes = $mysqli->query($findPereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $pere = $PereRes->fetch_array();
            if($pere) {
                $nomPere = $pere['nom'];
                $prenomPere = $pere['prenom'];
                $portablePere = $pere['telephone_portable'];
                $email = $pere['email'];
                $fixe = $pere['telephone_fixe'];
                $professionPere = $pere['profession'];
                $adresse = $pere['adresse'];
                $codePostal = $pere['code_postale'];
                $ville = $pere['ville'];

                $coursArabeAdultePere = $pere['cours_arabe_adulte'];
                $coursScienceIslamiquePere = $pere['cours_sciences_islamiques'];
            } else {
                $nomPere = "";
                $prenomPere = "";
                $portablePere = "";
                $coursArabeAdultePere = "";
                $coursScienceIslamiquePere = "";
            }

            // Recuperation Mere
            $findMereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'F'";
            $MereRes = $mysqli->query($findMereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $mere = $MereRes->fetch_array();
            if($mere) {
                $nomMere = $mere['nom'];
                $prenomMere = $mere['prenom'];
                $portableMere = $mere['telephone_portable'];
                $email = $mere['email'];
                $fixe = $mere['telephone_fixe'];
                $professionMere = $mere['profession'];
                $adresse = $mere['adresse'];
                $codePostal = $mere['code_postale'];
                $ville = $mere['ville'];

                $coursArabeAdulteMere = $mere['cours_arabe_adulte'];
                $coursScienceIslamiqueMere = $mere['cours_sciences_islamiques'];

            } else {
                $nomMere = "";
                $prenomMere = "";
                $portableMere = "";
                $coursArabeAdulteMere = "";
                $coursScienceIslamiqueMere = "";
            }

        ?>




      <form method="post" id="compte" name="inscription" action="modifierInscriptionParentsAction.php" onsubmit="return checkInputForm()">
        <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptionsFiltre.php">
        <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptionsFiltre.php">
          <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="<?php echo($idFoncInscription);?>">
          <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="<?php echo($idInscription);?>">

        <!-- Modification informations parents -->
        <section id="parents" class="dark">
        <header class="title">
          <h2>RENSEIGNEMENTS DES <span>PARENTS</span></h2>
          <!--<p>Les champs avec * sont obligatoires </p>-->
        </header>
        <div class="container">
          <div class="row">
            <div class="col-md-12 animated" data-animate="fadeInLeft">
                <div class="row">
                    <div class="col-md-12 animated messageErrorColore"
                         data-animate="fadeInLeft" role="alert">
                        <?php
                        if(isset($_SESSION['messageError'])) {
                            if ($_SESSION['messageError'] != null) {
                                echo ('<p class="text-danger">' . $_SESSION['messageError'] . '</p>');
                                unset($_SESSION['messageError']);
                            }
                        }
                        ?>
                    </div>
                  <div class="col-md-12">
                    <h3>Père</h3>
                  </div>
                  <div class="col-md-3">
                    Nom <input type="text" name="nomPere" class="form-control" placeholder="Nom du père" value="<?php echo($nomPere);?>" required>
                  </div>
                  <div class="col-md-3">
                    Prénom <input type="text" name="prenomPere" class="form-control" placeholder="prénom du père" value="<?php echo($prenomPere);?>" required>
                  </div>
                  <div class="col-md-3">
                    Profession <input type="text" name="professionPere" class="form-control" placeholder="Profession du père" value="<?php echo($professionPere);?>">
                  </div>
                  <div class="col-md-3">
                    Tél. portable <input type="text" name="portablePere" class="form-control" placeholder="Tél. portable du père" value="<?php echo($portablePere);?>"required>
                  </div>

                  <div class="col-md-12">
                    <h3>Mère</h3>
                  </div>
                  <div class="col-md-3">
                    Nom <input type="text" name="nomMere" class="form-control" placeholder="Nom du mère" value="<?php echo($nomMere);?>" required>
                  </div>
                  <div class="col-md-3">
                    Prénom <input type="text" name="prenomMere" class="form-control" placeholder="prénom du mère" value="<?php echo($prenomMere);?>" required>
                  </div>
                  <div class="col-md-3">
                    Profession <input type="text" name="professionMere" class="form-control" placeholder="Profession du mère" value="<?php echo($professionMere);?>">
                  </div>
                  <div class="col-md-3">
                    Tél. portable <input type="text" name="portableMere" class="form-control" placeholder="Tél. portable du mère" value="<?php echo($portableMere);?>" required>
                  </div>

                  <div class="col-md-4">
                    <br/>
                    Parents séparés <select id="parentsSepare" name="parentsSepare" class="form-control" required>
                                      <option value="" class="backgroundBlackColor" <?php if($parentsSepare == "") echo(' selected')?>>--</option>
                                      <option value="0" class="backgroundBlackColor" <?php if($parentsSepare == 0) echo(' selected')?>>NON</option>
                                      <option value="1" class="backgroundBlackColor" <?php if($parentsSepare == 1) echo(' selected')?>>OUI</option>
                                    </select>
                  </div>
                  <div class="col-md-4">
                    <br/>
                    Adresse e-mail <input type="email" id="email" name="email" class="form-control" placeholder="Adresse e-mail"
                                          value="<?php echo($email);?>"
                                          onchange="verifierDisponibMail(this.value)" required>
                  </div>
                  <div class="col-md-4">
                    <br/>
                    Téléphone fixe <input type="tel" name="telephoneFixe" class="form-control" placeholder="Téléphone fixe" value="<?php echo($fixe);?>">
                  </div>
                  <div class="col-md-6">
                    Adresse postale <input type="" name="adressePostale" class="form-control" placeholder="Adresse postale" value="<?php echo($adresse);?>" required>
                  </div>
                  <div class="col-md-3">
                    Code postale <input type="text" name="codePostale" class="form-control" placeholder="Code postale" value="<?php echo($codePostal);?>" required>
                  </div>
                  <div class="col-md-3">
                    Ville <input type="text" name="ville" class="form-control" rows="1" placeholder="Ville" value="<?php echo($ville);?>" required>
                  </div>

                </div>
                <div class="col-md-12">
                  </br>
                  <button class="btn btn-default center-block submit">Modifier</button>
                </div>

            </div>

          </div>
        </div>
      </section>










   </div><!-- /.container-fluid -->
   <!--  ============== FIN - CONTENT PRINCIPAL DE LA PAGE ==================== -->

        <!-- SCRIPT -->
        <script type="text/javascript" src="../ihm/js/main.js"></script>
    </body>
</html>