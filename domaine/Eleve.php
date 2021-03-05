<?php


class Eleve
{
    private $id;
    private $idInscription;
    private $nom;
    private $prenom;
    private $sex; // "M", "F"
    private $datenaissance;
    private $lieuNaissance;
    private $coursAnneePrec;
    private $coursAnneePrecIci; // boolean : true ou false
    private $numClassePrec; // String
    private $adresse;
    private $ville;
    private $codePostale;
    private $decharge; // boolean : true ou false
    private $autoriserPhotographie; // boolean : true ou false


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Eleve
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    } // boolean : true ou false

    /**
     * Eleve constructor.
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
     * @return Eleve
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
     * @return Eleve
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
     * @return Eleve
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
     * @return Eleve
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
     * @return Eleve
     */
    public function setMere($mere)
    {
        $this->mere = $mere;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdInscription()
    {
        return $this->idInscription;
    }

    /**
     * @param mixed $idInscription
     * @return Eleve
     */
    public function setIdInscription($idInscription)
    {
        $this->idInscription = $idInscription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     * @return Eleve
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * @param mixed $lieuNaissance
     * @return Eleve
     */
    public function setLieuNaissance($lieuNaissance)
    {
        $this->lieuNaissance = $lieuNaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoursAnneePrec()
    {
        return $this->coursAnneePrec;
    }

    /**
     * @param mixed $coursAnneePrec
     * @return Eleve
     */
    public function setCoursAnneePrec($coursAnneePrec)
    {
        $this->coursAnneePrec = $coursAnneePrec;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoursAnneePrecIci()
    {
        return $this->coursAnneePrecIci;
    }

    /**
     * @param mixed $coursAnneePrecIci
     * @return Eleve
     */
    public function setCoursAnneePrecIci($coursAnneePrecIci)
    {
        $this->coursAnneePrecIci = $coursAnneePrecIci;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumClassePrec()
    {
        return $this->numClassePrec;
    }

    /**
     * @param mixed $numClassePrec
     * @return Eleve
     */
    public function setNumClassePrec($numClassePrec)
    {
        $this->numClassePrec = $numClassePrec;
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
     * @return Eleve
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     * @return Eleve
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodePostale()
    {
        return $this->codePostale;
    }

    /**
     * @param mixed $codePostale
     * @return Eleve
     */
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDecharge()
    {
        return $this->decharge;
    }

    /**
     * @param mixed $decharge
     * @return Eleve
     */
    public function setDecharge($decharge)
    {
        $this->decharge = $decharge;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAutoriserPhotographie()
    {
        return $this->autoriserPhotographie;
    }

    /**
     * @param mixed $autoriserPhotographie
     * @return Eleve
     */
    public function setAutoriserPhotographie($autoriserPhotographie)
    {
        $this->autoriserPhotographie = $autoriserPhotographie;
        return $this;
    }




}