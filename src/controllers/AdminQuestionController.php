<?php

namespace controllers;

use models\Question;
use controllers\ConnexionController;
use models\Reponse;

class AdminQuestionController
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    private $connexion;
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public function __construct()
    {
        $this->connexion = new ConnexionController();
    }

    public function findAll()
    {

        // On execute une requette via le connexionController instancié  dans le constructeur
        // et sa propriete publique $connexion ($this->connexion qui est un objet mysqli)
        // ensuite on utilise la propriete connexion de mysqli pour executer la requete
        $req = $this->connexion->connexion->query('SELECT * FROM question');

        $datas = [];
        // Avec une boucle on met en place les questions
        while ($obj = $req->fetch_object()) {
            $question = new Question();
            $question->setId($obj->que_id);
            $question->setIntitule($obj->que_intitule);
            array_push($datas, $question);
        }


        return $datas;
    }

    /**
     * Méthodes qui renvoie une question et ses réponses
     */
    public function find($id)
    {
        $sql = 'SELECT * FROM `question` AS q JOIN reponse AS r ON r.rep_question_id=q.que_id WHERE q.que_id=' . $id . ' ORDER BY r.rep_id ASC';
        //echo $sql;
        $req = $this->connexion->connexion->query($sql);

        // Mise en place de la question (Objet)
        $question = new Question();
        $question->setId($id);
        $i = 0;
        while ($obj = $req->fetch_object()) {
            if ($i == 0) {
                $question->setIntitule($obj->que_intitule);
            }
            $reponse = new Reponse();
            $reponse->setId($obj->rep_id);
            $reponse->setTexte($obj->rep_texte);
            $reponse->setIsTrue($obj->rep_istrue);

            // Ajout de la reponse dans la collection de la question
            $question->addReponse($reponse);
        }
        return $question;
    }


    // Methode qui supprime une question
    // @param $id int l'id de la question à supprimer

    public function remove(int $id)
    {

        return $this->connexion->connexion->query('DELETE FROM question WHERE que_id=' . $id);
    }

    /* 

                     */
    public function add($post)
    {
        // print_r($post);
        // die();
        $intitule = htmlentities(htmlspecialchars(ucfirst($post["intitule"])));
        $sql = 'INSERT INTO question (que_intitule) VALUES ("' . $intitule . '")';
        $this->connexion->connexion->query($sql);
        // Récuperation de l'id 
        $id = $this->connexion->connexion->insert_id;

        // Prise en charge des reponses
        $i = 0;

        foreach ($post["reponses"] as $reponse) {
            $texte = htmlentities(htmlspecialchars(ucfirst($reponse)));
            $result = (!isset($post["results"][$i])) ? 0 : 1;
            $sql = 'INSERT INTO reponse (rep_texte, rep_question_id, rep_istrue) VALUES ("' . $texte . '",' . $id . ', ' . $result . ')';
            $this->connexion->connexion->query($sql);
            $i++;
        }
        return true;
    }
}
