<?php
class ConnexionBD {
    private static $_dbname = "web";
    private static $_user = "root";
    private static $_pwd = "EmnaGraja123..";
    private static $_host = "localhost";
    private static $_bdd = null;

    // Private constructor to prevent direct instantiation
    private function __construct() {
        try {
            self::$_bdd = new PDO(
                "mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8",
                self::$_user,
                self::$_pwd,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8')
            );
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Static method to return the PDO instance
    public static function getInstance() {
        if (self::$_bdd === null) {  // Explicit check for null
            new ConnexionBD();
        }
        return self::$_bdd;  // Return PDO instance
    }
}
?>
