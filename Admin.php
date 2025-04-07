<?php
class Admin extends User {
    public function __construct($id, $name, $email, $role) {	
        parent::__construct($id, $name, $email, "admin");//je considere que le username est le nom de l'administrateur
    }
  
    
    
}



?>