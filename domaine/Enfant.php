<?php


class Enfant
{
    private $nom;
    private $prenom;
    private $datenaissance;
    private $parent1;
    private $parent2;

    /**
     * Enfant constructor.
     * @param $nom
     * @param $prenom
     * @param $datenaissance
     * @param $parent1
     * @param $parent2
     */
    public function __construct($nom, $prenom, $datenaissance, $parent1, $parent2)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->datenaissance = $datenaissance;
        $this->parent1 = $parent1;
        $this->parent2 = $parent2;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Enfant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     * @return Enfant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * @param mixed $datenaissance
     * @return Enfant
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent1()
    {
        return $this->parent1;
    }

    /**
     * @param mixed $parent1
     * @return Enfant
     */
    public function setParent1($parent1)
    {
        $this->parent1 = $parent1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent2()
    {
        return $this->parent2;
    }

    /**
     * @param mixed $parent2
     * @return Enfant
     */
    public function setParent2($parent2)
    {
        $this->parent2 = $parent2;
        return $this;
    }




}