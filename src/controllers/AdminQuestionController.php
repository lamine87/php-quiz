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

     private function conformDataText($texte){
        return htmlentities(htmlspecialchars(ucfirst($texte)));
     }

    public function update($id, $post, $question){

        $reponsesActuelles = [];
        foreach ($question->getReponses() as $reponse){
            $rID = $reponse->getId();
            array_push($reponsesActuelles, $rID);
         }

        // Mise à jour de l'intitule de la question 
        $intitule = $this->conformDataText($post["intitule"]);
        $sql = 'UPDATE question SET que_intitule ="'.$intitule.'"WHERE que_id='.$id;
        $this->connexion->connexion->query($sql);
        foreach ($post["reponses"] as $key=>$value){
            $intitule = $this->conformDataText($value);
            $isTrue = (!isset($post["results"][$key])) ? 0 : 1;
            if(in_array($key, $reponsesActuelles)){
                $sql = 'UPDATE reponse SET rep_texte="'.$intitule.'", rep_istrue='.$isTrue.' WHERE rep_id='.$key;
                
                // Supprimer la clé du tableau ($reponsesActuelles)
                array_splice($reponsesActuelles, array_keys($reponsesActuelles, $key)[0], 1);
            }else{
                $sql = 'INSERT INTO reponse (rep_texte,rep_istrue, rep_question_id) VALUES ("'.$intitule.'",'.$isTrue.','.$id.')';
            //echo $key."<br>";
        }

        $this->connexion->connexion->query($sql);
     
      }

     // print_r($reponsesActuelles);
     die();

        // Si lr count de $reponsesActuelles > 0 avec une boucle on supprime les reponses correspondantes
        if(count($reponsesActuelles)>0){
        foreach ($reponsesActuelles as $id){
            $sql = "DELETE FROM reponse WHERE rep_id=".$id;
            $this->connexion->connexion->query($sql);
        }
        }
      return true;

    }
    public function find($id)

    {
        $sql = 'SELECT * FROM `question` AS q JOIN reponse AS r ON r.rep_question_id=q.que_id WHERE q.que_id=' .$id. ' ORDER BY r.rep_id ASC';
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

        return $this->connexion->connexion->query('DELETE FROM question WHERE que_id='.$id);
    }

    /* 

                     */
    public function add($post)
    {
        // print_r($post);
        // die();
        $intitule = $this->conformDataText($post["intitule"]);
        $sql = 'INSERT INTO question (que_intitule) VALUES ("'.$intitule.'")';
        $this->connexion->connexion->query($sql);
        // Récuperation de l'id 
        $id = $this->connexion->connexion->insert_id;

        // Prise en charge des reponses
        $i = 0;

        foreach ($post["reponses"] as $reponse) {
            $texte = htmlentities(htmlspecialchars(ucfirst($reponse)));
            $result = (!isset($post["results"][$i])) ? 0 : 1;
            $sql = 'INSERT INTO reponse (rep_texte, rep_question_id, rep_istrue) VALUES ("'.$texte.'",'.$id.', '.$result.')';
            $this->connexion->connexion->query($sql);
            $i++;
        }
        return true;
    }
}
