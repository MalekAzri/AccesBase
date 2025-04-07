<?php
function load(string $ConnexionBD)
{
    include_once "$ConnexionBD.php";
}
spl_autoload_register('load');
?>