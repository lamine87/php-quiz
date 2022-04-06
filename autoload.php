<?php 

class Autoloader{

    // Fonction statique qui permet l'enregistrement de l'autoloader dans l'application
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    // Fonction qui charge des classes appelées

    static function autoload($className){

        require 'src/'.$className.'.php';
    }
}

?>
