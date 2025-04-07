<?php
include "autoloader.php";
class Etudiant extends User {
    public $birthday;
    public $image;
    public $section;
    public $pdo;//connexion a la base de donnees

//je vais considerer que le username est le nom de l'etudiant

    public function __construct($id, $name, $email, $birthday,$image, $section) {
        parent::__construct($id, $name, $email, "etudiant");
        $this->birthday = $birthday;
        $this->image = $image;
        $this->section = $section;

    }
    

}




?>