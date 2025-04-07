<?php
include "autoloader.php";
class Etudiant extends User {
    public $birthday;
    public $image;
    public $section;
    public static ConnexionBD $pdo;//connexion a la base de donnees
    public static Repository $repoEtudiant; // repository pour les etudiants
//je vais considerer que le username est le nom de l'etudiant

    public function __construct($id, $name, $email, $birthday,$image, $section) {
        parent::__construct($id, $name, $email, "etudiant");
        $this->birthday = $birthday;
        $this->image = $image;
        $this->section = $section;

          if (self::$pdo === null) {
            self::$pdo = ConnexionBD::getInstance(); // Initialisation de PDO si ce n'est pas déjà fait
            self::$repoEtudiant = new Repository("etudiant", self::$pdo); // Initialisation du repository
        }

    }
        // Cette méthode renvoie les informations de l'étudiant sous forme de tableau (utilisée pour les inserts par un admin)
    // Elle est utilisée pour insérer un nouvel étudiant dans la base de données par la methode create de la classe Repository
    public function getInfo() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'image' => $this->image,
            'section' => $this->section
        ];
    }
    public function getEtudiants(){//un etudiant peut voir tous les etudiants
        return self::$repoEtudiant->findAll();

    }
    public function getEtudiantById($id){//un etudiant peut voir un etudiant par son id
        return self::$repoEtudiant->findById($id);
    }


}




?>