<?php


    function chaine_aleatoire($taille, $possibleCar)
    {
        if($possibleCar == null) {
            $possibleCar="azertyiopqsdfghjklmwxcvbn0123456789"; //Listes des caracteres possibles
        }
        $mdp='';
        $long=strlen($possibleCar);
        srand((double)microtime()*1000000); //Initialise le generateur de nombres aleatoires
        for($i=0;$i<$taille;$i++) {
            $mdp=$mdp.substr($possibleCar,rand(0,$long-1),1);
        }
        return $mdp;
    }