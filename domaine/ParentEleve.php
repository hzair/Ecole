<?php


class ParentEleve
{
    private $nom;
    private $prenom;
    private $datenaissance;
    private $adresse;
    private $telephonePortable;
    private $telephoneFixe;
    private $fonction;
    private $sexe; // M: masculin, F: feminin

    /**
     * ParentEleve constructor.
     * @param $nom
     * @param $prenom
     * @param $datenaissance
     * @param $adresse
     * @param $telephonePortable
     * @param $telephoneFixe
     * @param $fonction
     */
    public function __construct($nom, $prenom, $datenaissance, $adresse, $telephonePortable, $telephoneFixe, $fonction)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->datenaissance = $datenaissance;
        $this->adresse = $adresse;
        $this->telephonePortable = $telephonePortable;
        $this->telephoneFixe = $telephoneFixe;
        $this->fonction = $fonction;
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
     * @return ParentEleve
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
     * @return ParentEleve
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
     * @return ParentEleve
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     * @return ParentEleve
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephonePortable()
    {
        return $this->telephonePortable;
    }

    /**
     * @param mixed $telephonePortable
     * @return ParentEleve
     */
    public function setTelephonePortable($telephonePortable)
    {
        $this->telephonePortable = $telephonePortable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephoneFixe()
    {
        return $this->telephoneFixe;
    }

    /**
     * @param mixed $telephoneFixe
     * @return ParentEleve
     */
    public function setTelephoneFixe($telephoneFixe)
    {
        $this->telephoneFixe = $telephoneFixe;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * @param mixed $fonction
     * @return ParentEleve
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
        return $this;
    }



}