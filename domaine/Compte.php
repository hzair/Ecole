<?php


class Compte extends ParentEleve
{
    private $login; // obligatoire
    private $adresseMail; // obligatoire
    private $dateCreation; // obligatoire

    // Etat du compte : Activer - Desactiver - EnAttente
    private $status; // obligatoire

    /**
     * Compte constructor.
     * @param $login
     * @param $adresseMail
     * @param $dateCreation
     * @param $status
     */
    public function __construct($login, $adresseMail, $dateCreation, $status)
    {
        $this->login = $login;
        $this->adresseMail = $adresseMail;
        $this->dateCreation = $dateCreation;
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     * @return Compte
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    /**
     * @param mixed $adresseMail
     * @return Compte
     */
    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     * @return Compte
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Compte
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }




}