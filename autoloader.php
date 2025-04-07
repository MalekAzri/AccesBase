<?php
function load1(string $ConnexionBD)
{
    include_once "ConnexionBD.php";
}
spl_autoload_register('load1'); 
function load2(String $IRepository){
    include_once "IRepository.php";
}
spl_autoload_register("load2");
?>