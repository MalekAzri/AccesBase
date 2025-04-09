<?php
include "autoloader.php";

class Etudiant extends User {
  
    public static $pdo; // Connexion à la base de données
    public static $repoEtudiant ; // Repository pour les étudiants
    public static $repoSection ; // Repository pour les sections

    // Le constructeur de la classe Etudiant
    public function __construct(public $id,public  $name, public $email,public  $birthday,public $image,public $section) {
        parent::__construct($id, $name, $email, "etudiant");
        $this->birthday = $birthday;
        $this->image = $image;
        $this->section = $section;

        // Initialisation des propriétés statiques si ce n'est pas déjà fait
    }

    // Méthode statique pour initialiser les propriétés statiques
    public static function initialize() {
        if (self::$pdo === null) {
            self::$pdo = ConnexionBD::getInstance(); // initialize pdo if not already done
            self::$repoEtudiant = new Repository("etudiant", self::$pdo); // initialize repository for students
            self::$repoSection = new Repository("section", self::$pdo); // initialize repository for sections
        }
    }

    // Cette méthode renvoie les informations de l'étudiant sous forme de tableau (utilisée pour les inserts par un admin)
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

    // Méthodes supplémentaires
    public function getEtudiants() {
        return self::$repoEtudiant->findAll();
    }

    public function getEtudiantById($id) {
        return self::$repoEtudiant->findById($id);
    }

    public function getSections() {
        return self::$repoSection->findAll();
    }

    public function getSectionById($id) {
        return self::$repoSection->findById($id);
    }
}

?>
