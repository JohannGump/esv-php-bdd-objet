<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 29/03/2018
 * Time: 12:07
 */

class Stagiaire
{
    private $id;
    private $nom;
    private $prenom;
    private $telephone;
    private $dateDeNaissance;

    /**
     * Stagiaire constructor.
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $telephone
     * @param $dateDeNaissance
     */
    public function __construct($id, $nom, $prenom, $telephone, $dateDeNaissance)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * @param mixed $dateDeNaissance
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }


    static public function getAll() {

        // CONNEXION BDD PDO
        $dbh = new PDO('mysql:host=localhost;dbname=esv_m2i', "root", "");

        // requete sql pour récupérer tous les users
        $sql = "SELECT * FROM stagiaire";

        // execution de la requete
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        // récupération des résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}

