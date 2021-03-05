<?php


class Inscription
{
    private $id;
    private $dateInscription;
    private $eleves; // une liste d'Eleves 1..n
    private $pere;
    private $mere;
    private $parentsSepares;

    /**
     * @return mixed
     */
    public function getParentsSepares()
    {
        return $this->parentsSepares;
    }

    /**
     * @param mixed $parentsSepares
     * @return Inscription
     */
    public function setParentsSepares($parentsSepares)
    {
        $this->parentsSepares = $parentsSepares;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPere()
    {
        return $this->pere;
    }

    /**
     * @param mixed $pere
     * @return Inscription
     */
    public function setPere($pere)
    {
        $this->pere = $pere;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMere()
    {
        return $this->mere;
    }

    /**
     * @param mixed $mere
     * @return Inscription
     */
    public function setMere($mere)
    {
        $this->mere = $mere;
        return $this;
    }
    //private $compte;

    /**
     * Inscription constructor.
     * @param $dateInscription
     * @param $eleves
     * @param $pere
     * @param $mere
     */
    public function __construct($dateInscription, $eleves, $pere, $mere)
    {
        $this->dateInscription = $dateInscription;
        $this->eleves = $eleves;
        $this->pere = $pere;
        $this->mere = $mere;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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