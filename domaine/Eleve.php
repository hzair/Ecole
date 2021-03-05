<?php


class Eleve
{
    private $nom;
    private $prenom;
    private $numClassePrec;
    private $datenaissance;
    private $lieuNaissance;
    private $pere;
    private $mere;
    private $parentsSepares; // true ou false
    private $adresse;
    private $ville;
    private $codePostale;
    private $email;
    private $autoriserRentrerSeul; // true ou false
    private $autoriserPhotographie; // true ou false

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
        $this->pere = $parent1;
        $this->mere = $parent2;
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
    public function getPere()
    {
        return $this->pere;
    }

    /**
     * @param mixed $pere
     * @return Enfant
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
     * @return Enfant
     */
    public function setMere($mere)
    {
        $this->mere = $mere;
        return $this;
    }




}