<?php
include "autoloader.php";
 class Admin extends User {

    public static ConnexionBD $pdo; // connexion a la base de donnees
    public static Repository $repoEtudiant; // repository pour les etudiants

    public static Repository $repoSection;

    public function __construct($id, $name, $email, $role) {	
        parent::__construct($id, $name, $email, "admin"); // je considere que le username est le nom de l'administrateur
        if (self::$pdo === null) {
            self::$pdo = ConnexionBD::getInstance(); // initialize pdo if not already done
           self::$repoEtudiant = new Repository("etudiant", self::$pdo); // initialize repository for students
              self::$repoSection = new Repository("section", self::$pdo); // initialize repository for sections
        }
    }

    public function getEtudiants(){
        return self::$repoEtudiant->findAll();
    }
    public function getAllStudents() {
        $query = "SELECT id, name, email, section FROM students";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
   
    public function getSections(){
        return self::$repoSection->findAll();
    }
    public function addSection($data){
        self::$repoSection->create($data);
    }
    public function deleteSection($id){
        self::$repoSection->delete($id);
    }
    public function getSectionById($id){
        return self::$repoSection->findById($id);
    }
    public function updateSection($id, $data){
        $section = self::$repoSection->findById($id);
        if ($section) {
            self::$repoSection->update($id, $data);
        } else {
            throw new Exception("Section not found with ID: $id");
        }
    }

    
  

    
}



?>