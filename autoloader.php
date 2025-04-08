<?php
// Register autoload for the 'ConnexionBD' class, if not already registered
if (!function_exists('load1')) {
    function load1(string $ConnexionBD) {
        include_once $ConnexionBD . '.php';
    }
    spl_autoload_register('load1');
}

// Register autoload for the 'Etudiant' class, if not already registered
if (!function_exists('load3')) {
    function load3(String $Etudiant) {
        include_once "Etudiant.php";
    }
    spl_autoload_register("load3");
}

// Register autoload for the 'Repository' class, if not already registered
if (!function_exists('load4')) {
    function load4(String $Repository) {
        include_once "Repository.php";
    }
    spl_autoload_register("load4");
}
?>
