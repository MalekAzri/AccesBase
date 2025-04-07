<?php
include "autoloader.php";
 class Admin extends User {

    public static $pdo; // connexion a la base de donnees
    public static  $repoEtudiant; // repository pour les etudiants



    public function __construct($id, $name, $email, $role) {	
        parent::__construct($id, $name, $email, "admin"); // je considere que le username est le nom de l'administrateur
        if (self::$pdo === null) {
            self::$pdo = ConnexionBD::getInstance(); // initialize pdo if not already done
           self::$repoEtudiant = new Repository("etudiant", self::$pdo); // initialize repository for students
        }
    }

public function getEtudiants(){
        return self::$repoEtudiant->findAll();
    }

    public function addEtudiant(Etudiant $e){
        $data = $e->getInfo();//getInfo() retourne un tableau associatif contenant les informations de l'étudiant
        self::$repoEtudiant->create($data);   
 }
 
    public function deleteEtudiant($id){
        self::$repoEtudiant->delete($id);
    }
    public function getEtudiantById($id){
        return self::$repoEtudiant->findById($id);
    }
    public function updateEtudiant($id, $data){
        $etudiant = self::$repoEtudiant->findById($id);
        if ($etudiant) {
            self::$repoEtudiant->update($id, $data);
        } else {
            throw new Exception("Etudiant not found with ID: $id");
        }
    }

    
  

    
}



?>