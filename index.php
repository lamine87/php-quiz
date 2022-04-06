<?php 


// Mise en place de l'autoloader
require 'autoload.php';
Autoloader::register();

// On definie une variable ROOT_DIR pour mémoriser la racine du projet
define('ROOT_DIR', 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].'/php-quiz');

//  On recupere l'url de la barre d'adresse
$request = $_SERVER["REQUEST_URI"];

// On nettoie l'url du nom du dossier dans lequel on travaille
$uri = str_replace("/php-quiz",'', $request);

// On eclate la chaine de caractere en tableau
$final = explode('/',$uri);

//print_r($final);
// Avec un switch on prend en charge l'affichage des vues de depart
switch ($final[1]){
    case 'admin':
        require __DIR__.'/src/views/admin.php';
        break;
        default:
        require __DIR__.'/src/views/error404.php';
}

