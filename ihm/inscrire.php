<!DOCTYPE html>

<?php
require_once(__DIR__ . "/../service/conf/Config.php");
require_once(__DIR__ . "/../utils/fonctions.php");
include("../service/datasource/connectToBdd.php");
session_start();

if(!isset($_SESSION['idFoncInscription']) || !isset($_SESSION['idInscription']))  {
    if(!isset($_SESSION['messageError'])){
        $_SESSION['messageError'] = "Connectez-vous avec votre identifiant ou créez un nouveau compte";
    }
    header('Location: /'. USE_BASE_URL . 'index.php#connexion');
    exit;
}

?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscriptions - Création Compte</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>

		<link rel="stylesheet" href="css/style.css" />

    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="js/plugins.js"></script>


    </script>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <script type="application/javascript">
            function checkInputForm()
            {
                // 1 - verifier que nbrEnfants est un nombre
                var nbr = document.forms["inscription"]["nbrEnfants"].value;
                if (isNaN(nbr)) {
                    alert("!! Vous devez renseigner un nombre d'enfants !!");
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

    <!-- SVG -->
	<div class="svg-wrap">
      <svg width="64" height="64" viewBox="0 0 64 64">
        <path id="arrow-left" d="M26.667 10.667q1.104 0 1.885 0.781t0.781 1.885q0 1.125-0.792 1.896l-14.104 14.104h41.563q1.104 0 1.885 0.781t0.781 1.885-0.781 1.885-1.885 0.781h-41.563l14.104 14.104q0.792 0.771 0.792 1.896 0 1.104-0.781 1.885t-1.885 0.781q-1.125 0-1.896-0.771l-18.667-18.667q-0.771-0.813-0.771-1.896t0.771-1.896l18.667-18.667q0.792-0.771 1.896-0.771z"></path>
      </svg>

      <svg width="64" height="64" viewBox="0 0 64 64">
        <path id="arrow-right" d="M37.333 10.667q1.125 0 1.896 0.771l18.667 18.667q0.771 0.771 0.771 1.896t-0.771 1.896l-18.667 18.667q-0.771 0.771-1.896 0.771-1.146 0-1.906-0.76t-0.76-1.906q0-1.125 0.771-1.896l14.125-14.104h-41.563q-1.104 0-1.885-0.781t-0.781-1.885 0.781-1.885 1.885-0.781h41.563l-14.125-14.104q-0.771-0.771-0.771-1.896 0-1.146 0.76-1.906t1.906-0.76z"></path>
      </svg>
    </div>

    <!--  ============== DEBUT - CONTENT PRINCIPAL DE LA PAGE ==================== -->
    <div class="container-fluid">

        <!-- HEADER -->
        <section id="header">

          <!-- NAVIGATION -->
          <nav class="navbar navbar-fixed-top navbar-default bottom">
            <div class="container">
              <div class="navbar-header">
                <a class="navbar-brand" href="#header">Institut Espoir - Inscriptions</a>
              </div><!-- /.navbar-header -->

              <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if(isset($_SESSION['idInscription'])){
                        ?>
                        <form method="post" id="deconnexion" name="deconnexion" action="../service/deconnexionAction.php">
                            <INPUT TYPE='hidden' name='returnPage' value="ihm/index.php#connexion">
                            <li><button class="btn btn-default center-block submit">Déconnexion</button></li>
                        </form>
                        <?php
                    }
                    ?>
                </ul>
              </div> <!-- /.navbar-collapse -->
            </div> <!-- /.container -->
          </nav>

          <!-- SLIDER -->
          <div class="header-slide">
            <section>
              <div id="loader" class="pageload-overlay" data-opening="M 0,0 0,60 80,60 80,0 z M 80,0 40,30 0,60 40,30 z">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
                    <path d="M 0,0 0,60 80,60 80,0 Z M 80,0 80,60 0,60 0,0 Z"/>
                </svg>
              </div> <!-- /.pageload-overlay -->

              <div class="image-slide bg-fixed">
                <div class="overlay">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">

                        <div class="slider-content">
                          <h1></h1>
                          <p>Association Culturelle Educative De Bron</p>
                        </div>

                      </div> <!-- /.col-md-12 -->
                    </div> <!-- /.row -->
                  </div> <!-- /.container -->
                </div> <!-- /.overlay -->
              </div> <!-- /.image-slide -->


            </section>

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
                loaderSVG.show()
            </script>

          </div><!-- /.header-slide -->
        </section>
        <!-- HEADER END -->

        <?php
        $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);
        $idInscription = $_SESSION['idInscription'];

        // Recuperation Pere
        $findPereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'M'";
        $PereRes = $mysqli->query($findPereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
        $pere = $PereRes->fetch_array();

        // Recuperation Mere
        $findMereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'F'";
        $MereRes = $mysqli->query($findMereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
        $mere = $MereRes->fetch_array();

        if($pere) {
            $adresse = $pere["adresse"];
            $codePostale = $pere["code_postale"];
            $ville = $pere["ville"];
            $telFixe = $pere["telephone_fixe"];
            $email = $pere["email"];
        } else {
            $adresse = $mere["adresse"];
            $codePostale = $mere["code_postale"];
            $ville = $mere["ville"];
            $telFixe = $mere["telephone_fixe"];
            $email = $mere["email"];
        }
        ?>

        <!-- Information parents -->
        <section id="inscrire" class="dark">
        <header class="title">
          <h2>RENSEIGNEMENTS DES <span>PARENTS</span></h2>
            <?php  if(isset($_SESSION['idFoncInscription']) ) { ?>
                Votre identifiant d'inscription <a data-toggle="popover" title="Merci de le garder, il vous permettera de modifier votre inscription en inscrivant d'autres enfants ou adultes par exemple"> (+) </a>
            <input type="text" id="idFoncInscription" name="idFoncInscription" class="identifiantinscription"
                   value="<?php
                       echo($_SESSION['idFoncInscription']);
                   } ?> " disabled>
            <br/>
            <i class="fa fa-calendar rdvColor" aria-hidden="true">

            Pour valider l’inscription vous devez prendre un RDV en cliquant <a href="http://rdv.ecole.institutespoir.fr" onclick="window.open(this.href);return false">ICI</a> au plus tard le 25/05/2021
            </i>


        </header>
        <div class="container">
          <div class="row">
              <div class="col-md-12 animated" data-animate="fadeInLeft">
                  <div class="wrap animated" data-animate="fadeInDown">
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
                  </div>
              </div>
              <div class="row backgroundRecap">
                  <div class="col-md-8 animated" data-animate="fadeInLeft">
                    <div class="wrap animated" data-animate="fadeInDown">
                        <div class="col-md-12">
                            <address>
                                <?php if ($pere) { ?>
                                    <span><i class="fa fa-group fa-lg"></i> Mr <?php echo($pere["nom"]." ".$pere["prenom"]);?></span>
                                <?php } ?>
                                <?php if ($mere) { ?>
                                    <span><i class="fa fa-group fa-lg"></i> Mme <?php echo($mere["nom"]." ".$mere["prenom"]);?></span>
                                <?php } ?>
                                <span><i class="fa fa-phone fa-lg"></i>  <?php echo($telFixe);?></span>
                            </address>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4 animated" data-animate="fadeInRight">
                      <address>
                          <span><i class="fa fa-map-marker fa-lg"></i> <?php echo($adresse." ".$codePostale." - ".$ville);?></span>
                          <span>
                               <?php if ($pere) { ?><i class="fa fa-mobile-phone fa-lg"></i> <?php echo($pere["telephone_portable"]); ?>
                              &nbsp; &nbsp;  <?php } ?>
                              <?php if ($mere) { ?><i class="fa fa-mobile-phone fa-lg"></i> <?php echo($mere["telephone_portable"]); }?>
                          </span>
                          <span><i class="fa fa-envelope-o fa-lg"></i> <?php echo($email);?></span>
                      </address>
                  </div>
              </div>


              <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-12">
                          <br/>
                      </div>
                      <div class="col-md-6 animated" data-animate="fadeInLeft">
                          <div class="col-md-12">
                              Liste inscriptions enfants :
                          </div>
                          <?php
                                    $idInsciption_ = $_SESSION['idInscription'];
                                    $findEleveSql = "SELECT * from eleve where id_inscription='$idInsciption_' and type_cours='ENF'";
                                    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

                                    $result = $mysqli->query($findEleveSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
                                    if($result) {
                                        $i = 0;
                                        while ($data = mysqli_fetch_array($result)) {
                                            $i++;
                                            $sexe = $data['sexe'];
                                            $prenom = $data['prenom'];
                                            $nom = $data['nom'];;
                                            $sexe = $data['sexe'];

                                            echo('<div class="col-md-4">');
                                            echo('<input type="text" name="enfant'.$i.'" class="alert enfant' . $sexe . '" value="' . $prenom .' " disabled>');
                                            echo('</div>');
                                        }
                                        if ($i == 0) {
                                            echo('<div class="col-md-4">');
                                            echo(' - Aucun - ');
                                            echo('</div>');
                                        }
                                    } else {
                                        echo ('Erreur affichage eleves : ' . $mysqli->error);
                                    }

                                ?>
                      </div>
                      <div class="col-md-6 animated" data-animate="fadeInRight">
                          <div class="col-md-12">
                              Liste inscriptions adultes :
                          </div>
                          <?php
                              $idInsciption_ = $_SESSION['idInscription'];
                              $findEleveSql = "SELECT * from eleve where id_inscription='$idInsciption_' and (type_cours='SCIENCES_ISLAMIQUES' or type_cours='ARABE')";
                              $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

                              $result = $mysqli->query($findEleveSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
                              if($result) {
                                  $i = 0;
                                  while ($data = mysqli_fetch_array($result)) {
                                      $i++;
                                      $sexe = $data['sexe'];
                                      $prenom = $data['prenom'];
                                      $nom = $data['nom'];;
                                      $sexe = $data['sexe'];
                                      if($data['type_cours'] == "SCIENCES_ISLAMIQUES"){
                                          $typeCoure = "Sc. Islamiques";
                                      } else {
                                          $typeCoure = "Cours Arabe";
                                      }

                                      echo('<div class="col-md-5">');
                                      echo('<input type="text" name="enfant'.$i.'" class="alert enfant' . $sexe . '" value="' . $prenom .' ('. $typeCoure .')" disabled>');
                                      echo('</div>');
                                  }
                                  if ($i == 0) {
                                      echo('<div class="col-md-4">');
                                      echo(' - Aucun - ');
                                      echo('</div>');
                                  }
                              } else {
                                  echo ('Erreur affichage eleves : ' . $mysqli->error);
                              }

                              ?>
                      </div>
                  </div>
              </div>

              <div class="col-md-12 animated" data-animate="fadeInLeft">
                  <div class="wrap animated" data-animate="fadeInDown">
                      <div class="col-md-12">
                          <br/>
                      </div>
                      <div class="col-md-12">
                          <br/>
                      </div>
                      <div class="col-md-6">
                          <form action="ajouterEleves.php#eleves">
                            <button class="btn btn-default center-block submit" >Inscrire Enfant</button>
                          </form>
                      </div>
                      <div class="col-md-6">
                          <form action="ajouterAdultes.php#adulte">
                            <button class="btn btn-default center-block submit" href="#inscrirAdultes">Inscrire Adulte</button>
                          </form>
                      </div>



                  </div>
              </div>

          </div>
        </div>
      </section>






        <section id="footer">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <p>ASSOCIATION CULTURELLE EDUCATIVE DE BRON</p>
                <p><i class="fa fa-heart"></i><small>  Institut Espoir  </small><i class="fa fa-heart"></i></p>
              </div>
            </div>
          </div>
        </section>

   </div><!-- /.container-fluid -->
   <!--  ============== FIN - CONTENT PRINCIPAL DE LA PAGE ==================== -->
    
    <!-- SCRIPT -->
    <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>