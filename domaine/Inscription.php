<?php


class Inscription
{
    private $dateInscription;
    private $compte;
    private $eleves; // une liste d'Enfants 1..n

    /**
     * Inscription constructor.
     * @param $dateInscription
     * @param $compte
     * @param $eleves
     */
    public function __construct($dateInscription, $compte, $eleves)
    {
        $this->dateInscription = $dateInscription;
        $this->compte = $compte;
        $this->eleves = $eleves;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     * @return Inscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * @param mixed $compte
     * @return Inscription
     */
    public function setCompte($compte)
    {
        $this->compte = $compte;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEleves()
    {
        return $this->eleves;
    }

    /**
     * @param mixed $eleves
     * @return Inscription
     */
    public function setEleves($eleves)
    {
        $this->eleves = $eleves;
        return $this;
    }




}