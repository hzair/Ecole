<!DOCTYPE html>

<?php
require_once(__DIR__ . "/../service/conf/Config.php");
require_once(__DIR__ . "/../utils/fonctions.php");
include("../service/datasource/connectToBdd.php");
session_start();
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscriptions - Demande d'informations</title>

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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#header">Institut Espoire - Inscriptions</a>
              </div><!-- /.navbar-header -->

              <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#header">Home</a></li>
                  <li><a href="#introduction">Introduction</a></li>
                  <li><a href="#parents">Inscription</a></li>
                  <li><a href="ajouterEleves.php#eleves">Partie Eleves</a></li>
                  <!--<li><a href="#contact">Contact</a></li>-->
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

              <nav class="nav-slide">
                <a class="prev" href="#prev">
                  <span class="icon-wrap">
                    <svg class="icon" width="32" height="32" viewBox="0 0 64 64">
                      <use xlink:href="#arrow-left">
                    </svg>
                  </span>
                  <div>
                    <span>Prev Photo</span>
                    <h3>...</h3>
                    <p>...</p>
                    <img alt="Previous thumb">
                  </div>
                </a>
                <a class="next" href="#next">
                  <span class="icon-wrap">
                    <svg class="icon" width="32" height="32" viewBox="0 0 64 64">
                      <use xlink:href="#arrow-right">
                    </svg>
                  </span>
                  <div>
                    <span>Next Photo</span>
                    <h3>...</h3>
                    <p>...</p>
                    <img alt="Next thumb">
                  </div>
                </a>
              </nav>
            </section>

            <script type="text/javascript">
            var dataHeader = [
                                {
                                  bigImage :"images/slide-2.jpg",
                                  title : "Inscription 2021-2022"
                                },
                                {
                                  bigImage :"images/institut-espoire.png",
                                  title : "Institut Espoire"
                                }
                            ],
                loaderSVG = new SVGLoader(document.getElementById('loader'), {speedIn : 800, speedOut : 800, easingIn : mina.easeinout});
                loaderSVG.show()
            </script>

          </div><!-- /.header-slide -->
        </section>
        <!-- HEADER END -->


        <!-- INTRODUCTION -->
        <section id="introduction" class="light">
            <header class="title">
              <h2>Introduction - <span> Formulaire d'inscription </span></h2>
            </header>

            <div class="container">
              <div class="row table-row">
                <div class="col-sm-6 hidden-xs">
                  <div class="section-content">
                    <div class="big-image" style="background-image:url(images/1.png)"></div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="section-content">
                    <div class="about-content left animated" data-animate="fadeInLeft">
                      <div class="about-icon"><i class="fa fa-calendar"></i></div>
                      <div class="about-detail">
                        <h4>Année scolaire</h4>
                        <p>
                          Ce <a href="#parents">formulaire</a> est uniquement pour les nouveaux élèves qui vont s’inscrire pour l’année <strong>2020-2021</strong>
                          <br>
                          Merci de le remplir, et de cliquer sur le bouton <strong>"Envoyer"</strong>
                        </p>
                      </div>
                    </div>

                    <div class="about-content left animated" data-animate="fadeInLeft">
                      <div class="about-icon"><i class="fa fa-desktop"></i></div>
                      <div class="about-detail">
                        <h4>Adresse</h4>
                        <p>Institut Espoir : 362 route de Genas Bron 69500 </p>
                          </div>
                    </div>

                    <div class="about-content left animated" data-animate="fadeInLeft">
                      <div class="about-icon"><i class="fa fa-mail-reply-all"></i></div>
                      <div class="about-detail">
                        <h4>Email</h4>
                        <p>Contactez-nous par eMail : <strong>inscriptions.institutespoir@gmail.com </strong></p>
                        </p>
                      </div>
                    </div>

                    <div class="about-content left animated" data-animate="fadeInLeft">
                      <div class="about-icon"><i class="fa fa-mobile-phone"></i></div>
                      <div class="about-detail">
                        <h4>Téléphone</h4>
                        <p>Contactez-nous au : <strong> (33) 6 87 93 16 89 </strong> </strong></p>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- /.row table-row -->
            </div> <!-- /.container -->
      </section>

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


          //var elmt = document.getElementById(id).;
        }

      </script>

      <form method="post" id="inscription" name="inscription" action="../service/ajouterInscriptionParentsAction.php" onsubmit="return checkInputForm()">
        <INPUT TYPE='hidden' name='returnPage' value="ihm/ajouterEleves.php#eleves">
        <INPUT TYPE='hidden' name='returnErrorPage' value="ihm/index.php#parents">

        <!-- Creation Inscription avec information parent -->
        <section id="parents" class="dark">
        <header class="title">
          <h2>RENSEIGNEMENTS - <span>PARENTS</span></h2>
          <!--<p>Les champs avec * sont obligatoires </p>-->
        </header>
        <div class="container">
          <div class="row">
            <div class="col-md-12 animated" data-animate="fadeInLeft">
                <div class="row">
                  <div class="col-md-12">
                    <h3>Père</h3>
                  </div>
                  <div class="col-md-3">
                    Nom <input type="text" name="nomPere" class="form-control" placeholder="Nom du père" required>
                  </div>
                  <div class="col-md-3">
                    Prénom <input type="text" name="prenomPere" class="form-control" placeholder="prénom du père" required>
                  </div>
                  <div class="col-md-3">
                    Profession <input type="text" name="professionPere" class="form-control" placeholder="Profession du père">
                  </div>
                  <div class="col-md-3">
                    Tél. portable <input type="text" name="portablePere" class="form-control" placeholder="Tél. portable du père" required>
                  </div>
                  <div class="col-md-12">
                    Voulez-vous inscrir au cours <select id="coursAdultPere" name="coursAdultPere" class="form-control" required>
                          <option value="" class="backgroundBlackColor" selected>--</option>
                          <option value="NON" class="backgroundBlackColor">NON</option>
                          <option value="coursArabeAdulte" class="backgroundBlackColor" >Arabe adulte</option>
                          <option value="coursSciencesIslamiques" class="backgroundBlackColor" >Sciences islamiques</option>
                          <option value="coursLesDeux" class="backgroundBlackColor" >Arabe adulte & sciences islamiques</option>
                      </select>
                  </div>

                  <div class="col-md-12">
                    <h3>Mère</h3>
                  </div>
                  <div class="col-md-3">
                    Nom <input type="text" name="nomMere" class="form-control" placeholder="Nom du mère" required>
                  </div>
                  <div class="col-md-3">
                    Prénom <input type="text" name="prenomMere" class="form-control" placeholder="prénom du mère" required>
                  </div>
                  <div class="col-md-3">
                    Profession <input type="text" name="professionMere" class="form-control" placeholder="Profession du mère">
                  </div>
                  <div class="col-md-3">
                    Tél. portable <input type="text" name="portableMere" class="form-control" placeholder="Tél. portable du mère" required>
                  </div>
                  <div class="col-md-12">
                    Voulez-vous inscrir au cours <select id="coursAdultMere" name="coursAdultMere" class="form-control" required>
                                                    <option value="" class="backgroundBlackColor" selected>--</option>
                                                    <option value="NON" class="backgroundBlackColor">NON</option>
                                                    <option value="coursArabeAdulte" class="backgroundBlackColor" >Arabe adulte</option>
                                                    <option value="coursSciencesIslamiques" class="backgroundBlackColor" >Sciences islamiques</option>
                                                    <option value="coursLesDeux" class="backgroundBlackColor" >Arabe adulte & sciences islamiques</option>
                                                  </select>
                  </div>

                  <div class="col-md-4">
                    <br/>
                    Parents séparés <select id="parentsSepare" name="parentsSepare" class="form-control" required>
                                      <option value="" class="backgroundBlackColor" selected>--</option>
                                      <option value="0" class="backgroundBlackColor">NON</option>
                                      <option value="1" class="backgroundBlackColor">OUI</option>
                                    </select>
                  </div>
                  <div class="col-md-4">
                    <br/>
                    Adresse e-mail <input type="text" name="email" class="form-control" placeholder="Adresse e-mail" required>
                  </div>
                  <div class="col-md-4">
                    <br/>
                    Téléphone fixe <input type="tel" name="telephoneFixe" class="form-control" placeholder="Téléphone fixe">
                  </div>
                  <div class="col-md-6">
                    Adresse postale <input type="text" name="adressePostale" class="form-control" placeholder="Adresse postale" required>
                  </div>
                  <div class="col-md-3">
                    Code postale <input type="text" name="codePostale" class="form-control" placeholder="Code postale" required>
                  </div>
                  <div class="col-md-3">
                    Ville <input type="text" name="ville" class="form-control" rows="1" placeholder="Ville" required>
                  </div>
                  <div>
                      <input type="checkbox" name="condition" rows="1" required>
                        Je déclare avoir pris connaissance des conditions d'inscription.
                    </div>
                </div>
                <div class="col-md-12">
                  </br>
                  <button class="btn btn-default center-block submit">Envoyer</button>
                </div>
            </div>

           <!--
           <div class="col-md-4 animated" data-animate="fadeInRight">
              <div class="col-md-12">
                <br/><br/><br/><br/><br/><br/><br/><br/>
                <span> <a href="#eleves">Etape suivante >></a> </span>
              </div>
            </div>
            -->

          </div>
        </div>
      </section>








        <!-- FORMULAIRE - CONTACTER NOUS
         <section id="contact" class="dark">
          <header class="title">
            <h2>Nous contacter <span>Fr</span></h2>
            <p>Pour plus d'informations, vous pouvez nous envoyer vos questions/remarques via ce formulaire</p>
          </header>
          <div class="container">
            <div class="row">
              <div class="col-md-8 animated" data-animate="fadeInLeft">
                <form action="#">
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" class="form-control" placeholder="Votre Nom">
                    </div>
                    <div class="col-md-6">
                      <input type="email" class="form-control" placeholder="Votre Email">
                    </div>
                    <div class="col-md-12">
                      <textarea class="form-control" rows="3" placeholder="Message..."></textarea>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-default submit">Envoi Message</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="col-md-4 animated" data-animate="fadeInRight">
                <address>
                    <span><i class="fa fa-map-marker fa-lg"></i> 362 Route de Genas, 69500 Bron</span>
                    <span><i class="fa fa-phone fa-lg"></i> (33) 6 87 93 16 89 </span>
                    <span><i class="fa fa-envelope-o fa-lg"></i> <a href="mailto:inscriptions.institutespoir@gmail.com">contact&#64; inscriptions.institutespoir@gmail.com</a></span>
                    <span><i class="fa fa-globe fa-lg"></i> <a href="http://support.example.com">support.example.com</a></span>
                </address>
              </div>

            </div>
          </div>
        </section>

        -->

        <section id="footer">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <p>ASSOCIATION CULTURELLE EDUCATIVE DE BRON</p>
                <p><i class="fa fa-heart"></i><small>  Institut Espoire  </small><i class="fa fa-heart"></i></p>
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