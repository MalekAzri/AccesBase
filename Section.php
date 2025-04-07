<?php
class Section{
    public $id;
    public $designation;
    public $description;
    public function __construct($id, $designation, $description) {
        $this->id = $id;
        $this->designation = $designation;
        $this->description = $description;
    }
}







?>