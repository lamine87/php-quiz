<?php 
        namespace controllers;

        use mysqli;

        class ConnexionController{
 
                private $bddUser = "root";
                private $bddPassword = "";
                private $server = "localhost";
                private $bddName = "php_quiz";
                public $connexion;
                

                public function __construct(){
                    // On verifie s'il a pas de connexion existante
                    if(!isset($this->connexion)){
                        $this->connexion = new mysqli($this->server, $this->bddUser, $this->bddPassword, $this->bddName);
                        // On declenche une erreur si on s'est pas connecté 
                        if(!$this->connexion){
                            echo "Erreur de connexion à la base de données";
                            exit;
                        }
                    }
                    // On renvoie la connexion active
                    return $this->connexion;
                }
        }
