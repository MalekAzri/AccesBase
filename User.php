<?php
class User {
    public $id;
    public $username;
    public $email;
    public $role;
    public function __construct($id, $username, $email, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
    }
    
}
?>