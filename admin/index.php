<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
      <?php
          session_start();

            $myUsername = "admin";
            $myPassword = "espoir123";

              $message = "";
            if((isset($_REQUEST['username']) && isset($_REQUEST['password'])
                    && $_REQUEST['username'] == $myUsername && $_REQUEST['password'] == $myPassword)
                ||  $_SESSION['ADMIN_IS_CONNECT'] == $myUsername) {
                $_SESSION['ADMIN_IS_CONNECT'] = $_REQUEST['username'];
                header("Location: menuAdmin.php");

            }else{
              $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
            }
      ?>
      <form class="box" action="" method="post" name="login">
            <h1 class="box-logo box-title">ADMINISTRATION - INSTITUT ESPOIR</h1>
            <h1 class="box-title">Connexion</h1>
          <?php if ($message != "") {
                  echo ('<p class="text-danger">' . $message . '</p>');
              }
          ?>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" class="box-input" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Connexion" name="submit" class="box-button">

      </form>
  </body>
</html>