<?php
    session_start();
    if (!isset($_SESSION['ADMIN_IS_CONNECT'])) {
        header("Location: index.php");
    }

?>


<table border="1" align="center" style="background-color: #1d1d1d">
    <thead>
    <tr>
        <th style="color: white"><a href="listeInscriptionsFiltre.php" style="color: white">&nbsp; &nbsp;La liste des Inscriptions&nbsp; &nbsp;</a></th>
        <th style="color: white"><a href="listeElevesFiltre.php" style="color: white"> &nbsp; &nbsp;La liste des Eleves&nbsp; &nbsp;</a></th>
        <th style="color: white"><a href="listeElevesByClasse.php" style="color: white">&nbsp; &nbsp;La liste des Eleves Par classe &nbsp; &nbsp;</a></th>
        <th style="color: white"><a href="deconnexion.php" style="color: white">&nbsp; &nbsp;Déconnexion&nbsp; &nbsp;</a></th>
    </tr>
    </thead>

</table>