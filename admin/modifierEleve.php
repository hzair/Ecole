<!DOCTYPE html>

<?php
require_once(__DIR__ . "/../service/conf/Config.php");
require_once(__DIR__ . "/../utils/fonctions.php");
include("../service/datasource/connectToBdd.php");
session_start();

//$success_page = $_POST['returnPage'];
//$err_page = $_POST['returnErrorPage'];
$idFoncInscription = $_POST['idFoncInscription'];
$idInscription = $_POST['idInscription'];
$idEleve = $_POST['idEleve'];
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
            $findEleveSql = "SELECT * FROM eleve where id = '$idEleve'";
            $eleveRes = $mysqli->query($findEleveSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $eleve = $eleveRes->fetch_array();
            if($eleve) {
                $nom= $eleve['nom'];
                $prenom = $eleve['prenom'];
                $sexe = $eleve['sexe'];
                $date_naissance = $eleve['date_naissance'];
                $lieu_naissance = $eleve['lieu_naissance'];
                $type_cours = $eleve['type_cours'];
                $cours_annee_prec = $eleve['cours_annee_prec'];
                $cours_annee_prec_ici = $eleve['cours_annee_prec_ici'];
                $num_annee_prec_ici = $eleve['num_annee_prec_ici'];
                $decharge = $eleve['decharge'];
                $autorisation_photo = $eleve['autorisation_photo'];
            } else {
                $nom= "";
                $prenom = "";
                $sexe = "";
                $date_naissance = "";
                $lieu_naissance = "";
                $type_cours = "";
                $cours_annee_prec = "";
                $cours_annee_prec_ici = "";
                $num_annee_prec_ici = "";
                $decharge = "";
                $autorisation_photo = "";
            }

        ?>




      <form method="post" id="compte" name="inscription" action="modifierEleveAction.php" onsubmit="return checkInputForm()">
        <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptionsFiltre.php">
        <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptionsFiltre.php">
          <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="<?php echo($idFoncInscription);?>">
          <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="<?php echo($idInscription);?>">
          <INPUT TYPE="hidden" id= "idEleve" name="idEleve" value="<?php echo($idEleve);?>">

        <!-- Modification informations eleve -->
              <!-- ELEVES -->
              <section id="eleves" class="dark">
                  <header class="title">
                      <h2>MODIFICATION INFORMATIONS - <span>ELEVE</span></h2>
                      <!--<p>Les champs avec * sont obligatoires </p>-->
                  </header>
                  <div class="container">
                      <div class="row">
                          <div class="col-md-12 animated" data-animate="fadeInLeft">
                              <div class="row">
                                  <div class="col-md-12">
                                      <?php  if(isset($_SESSION['idFoncInscription']) ) { ?>
                                          Votre identifiant d'inscription <a data-toggle="popover" title="Merci de le garder, il vous permettera de modifier votre inscription en ajoutant d'autres enfant par exemple"> (+) </a>
                                      <?php  } else { ?>
                                          Renseignez votre identifiant d'inscription <a data-toggle="popover" title="Merci de vous inscrire si vous ne possédez pas d'un numéro d'inscription"> (+) </a>
                                      <?php  } ?>
                                      <input type="text" id="newIdFoncInscription" name="newIdFoncInscription" class="identifiantinscription"
                                             value="<?php
                                                 echo($idFoncInscription . '">');
                                              ?>

                                <br/>
                            </div>

                            <div class="col-md-4">
                                      Nom de l'élève <input type="text" name="nomEleve" class="form-control" value="<?php echo($nom);?>" required>
                                  </div>
                                  <div class="col-md-4">
                                      Prémon de l'élève <input type="text" name="prenomEleve" class="form-control"  value="<?php echo($prenom);?>"  required>
                                  </div>
                                  <div class="col-md-4">
                                      Sexe <select id="sexeEleve" name="sexeEleve" class="form-control" required>
                                          <option value="" class="backgroundBlackColor"  selected>--</option>
                                          <option value="F" class="backgroundBlackColor" <?php if($sexe == "F") echo("selected");?> >FEMININ</option>
                                          <option value="M" class="backgroundBlackColor" <?php if($sexe == "M") echo("selected");?> >MASCULIN</option>
                                      </select>
                                  </div>
                                  <div class="col-md-6">
                                      Date de naissance<input type="date" id="dateNaissEleve" name="dateNaissEleve" class="form-control"  value="<?php echo($date_naissance);?>"  required>
                                  </div>
                                  <div class="col-md-6">
                                      Lieu de naissance <input type="text" id="lieuNaissEleve" name="lieuNaissEleve" class="form-control"  value="<?php echo($lieu_naissance);?>"  required>
                                  </div>
                                  <div class="col-md-4">
                                      L'enfant a-t-il déjà suivi des cours d'arabe ?
                                      <select id="suiviCourEleve" name="suiviCourEleve" class="form-control">
                                          <option value="" class="backgroundBlackColor" selected>--</option>
                                          <option value="1" class="backgroundBlackColor" <?php if($cours_annee_prec == 1) echo("selected");?>>OUI</option>
                                          <option value="0" class="backgroundBlackColor" <?php if($cours_annee_prec == 0) echo("selected");?>>NON</option>
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      Au sein de notre école durant 2020/2021 ?
                                      <select id="suiviCourIciEleve" name="suiviCourIciEleve" class="form-control">
                                          <option value="" class="backgroundBlackColor" selected>--</option>
                                          <option value="1" class="backgroundBlackColor" <?php if($cours_annee_prec_ici == 1) echo("selected");?>>OUI</option>
                                          <option value="0" class="backgroundBlackColor" <?php if($cours_annee_prec_ici == 0) echo("selected");?>>NON</option>
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      N° de Classe
                                      <select id="numClasseEleve" name="numClasseEleve" class="form-control">
                                          <option value="" class="backgroundBlackColor" selected>--</option>
                                          <option value="C 01 - N 2A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 01 - N 2A") echo("selected");?>>C 01 - N 2A</option>
                                          <option value="C 04 - N 1B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 04 - N 1B") echo("selected");?>>C 04 - N 1B</option>
                                          <option value="C 05 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 05 - N 1A") echo("selected");?>>C 05 - N 1A</option>
                                          <option value="C 07 - N 2A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 07 - N 2A") echo("selected");?>>C 07 - N 2A</option>
                                          <option value="C 08 - N 1B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 08 - N 1B") echo("selected");?>>C 08 - N 1B</option>
                                          <option value="C 09 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 09 - N 1A") echo("selected");?>>C 09 - N 1A</option>
                                          <option value="C 10 - N 2B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 10 - N 2B") echo("selected");?>>C 10 - N 2B</option>
                                          <option value="C 11 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 11 - N 1A") echo("selected");?>>C 11 - N 1A</option>
                                          <option value="C 12 - N 1B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 12 - N 1B") echo("selected");?>>C 12 - N 1B</option>
                                          <option value="C 14 - N 1B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 14 - N 1B") echo("selected");?>>C 14 - N 1B</option>
                                          <option value="C 15 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 15 - N 1A") echo("selected");?>>C 15 - N 1A</option>
                                          <option value="C 16 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 16 - N 1A") echo("selected");?>>C 16 - N 1A</option>
                                          <option value="C 17 - N 3B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 17 - N 3B") echo("selected");?>>C 17 - N 3B</option>
                                          <option value="C 18 – N1B S" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 18 – N1B S") echo("selected");?>>C 18 – N1BS</option>
                                          <option value="C 19 - N 2A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 19 - N 2A") echo("selected");?>>C 19 - N 2A</option>
                                          <option value="C 20 - N 1B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 20 - N 1B") echo("selected");?>>C 20 - N 1B</option>
                                          <option value="C 21 - N 4A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 21 - N 4A") echo("selected");?>>C 21 - N 4A</option>
                                          <option value="C 22 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 22 - N 1A") echo("selected");?>>C 22 - N 1A</option>
                                          <option value="C 23 - N 2B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 23 - N 2B") echo("selected");?>>C 23 - N 2B</option>
                                          <option value="C 24 - N 1B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 24 - N 1B") echo("selected");?>>C 24 - N 1B</option>
                                          <option value="C 25 - N 5B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 25 - N 5B") echo("selected");?>>C 25 - N 5B</option>
                                          <option value="C 25 bis - N 3B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 25 bis - N 3B") echo("selected");?>>C 25 bis - N 3B</option>
                                          <option value="C 26 - N 2B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 26 - N 2B") echo("selected");?>>C 26 - N 2B</option>
                                          <option value="C 27 - N 3B" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 27 - N 3B") echo("selected");?>>C 27 - N 3B</option>
                                          <option value="C 28 - N 2A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 28 - N 2A") echo("selected");?>>C 28 - N 2A</option>
                                          <option value="C 29 - N 1A" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C 29 - N 1A") echo("selected");?>>C 29 - N 1A</option>
                                          <option value="C ADOS F" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C ADOS F") echo("selected");?>>C ADOS F</option>
                                          <option value="C ADOS G1" class="backgroundBlackColor" <?php if($num_annee_prec_ici == "C ADOS G1") echo("selected");?>>C ADOS G1</option>
                                      </select>
                                  </div>

                                  <div class="col-md-6">
                                      DECHARGE
                                      <select id="dechargeEleve" name="dechargeEleve" class="form-control" required>
                                          <option value="" class="backgroundBlackColor" selected>--</option>
                                          <option value="1" class="backgroundBlackColor" <?php if($decharge == 1) echo("selected");?>>J’autorise mon fils, ma fille à renter seul(e) à la maison</option>
                                          <option value="0" class="backgroundBlackColor" <?php if($decharge == 0) echo("selected");?>>Je n’autorise pas mon fils, ma fille à renter seul(e) à la maison</option>
                                      </select>
                                  </div>
                                  <div class="col-md-6" >
                                      Autorisation de photographie <a data-toggle="popover"
                                                                      title="L’association A.C.E.B :
- A photographier et à utiliser l’image (photo de classe ou autre) de notre enfant, conformément aux dispositions relatives au droit à l’image et au droit au nom.
- A fixer, reproduire et communiquer au public les photographies prises dans le cadre des activités de l’association. Les photographies pourront être exploitées et utilisées directement, sous toute forme et tous supports connus et inconnus à ce jour, dans le monde entier, sans aucune limitation de temps et d’espace et ce sans préjudice au règlement intérieur de l’association.">(+)</a>
                                      <select id="photographieEleve" name="photographieEleve" class="form-control" required>
                                          <option value="" class="backgroundBlackColor" selected>--</option>
                                          <option value="1" class="backgroundBlackColor" <?php if($autorisation_photo == 1) echo("selected");?>>J’autorise</option>
                                          <option value="0" class="backgroundBlackColor" <?php if($autorisation_photo == 0) echo("selected");?>>Je n’autorise pas</option>
                                      </select>
                                  </div>


                                  <div class="col-md-06">
                                      <br/>
                                      <button class="btn btn-default center-block submit">Modifier Eleve</button>
                                  </div>
                                  <div class="col-md-6">
                                      <a href="listeInscriptionsFiltre.php"> Retour >> </a>
                                      <br/><br/>
                                  </div>




                              </div>
                          </div>

                      </div>
                  </div>
              </section>


          </form>










   </div><!-- /.container-fluid -->
   <!--  ============== FIN - CONTENT PRINCIPAL DE LA PAGE ==================== -->

        <!-- SCRIPT -->
        <script type="text/javascript" src="../ihm/js/main.js"></script>
    </body>
</html>