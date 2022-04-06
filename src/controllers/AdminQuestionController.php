<?php 
        namespace controllers;

        use models\Question;
        use controllers\ConnexionController;
    
        class AdminQuestionController{
         // ====================================================== //
        // ===================== PROPRIETES ===================== //
        // ====================================================== //
            private $connexion;
        // ====================================================== //
        // ===================== PROPRIETES ===================== //
        // ====================================================== //
            public function __construct(){
                $this->connexion = new ConnexionController();
            }

            public function findAll(){

                // On execute une requette via le connexionController instancié  dans le constructeur
                // et sa propriete publique $connexion ($this->connexion qui est un objet mysqli)
                // ensuite on utilise la propriete connexion de mysqli pour executer la requete
                $req = $this->connexion->connexion->query('SELECT * FROM question');
                
                $datas = [];
                // Avec une boucle on met en place les questions
                while($obj = $req->fetch_object()){
                    $question = new Question();
                    $question->setId($obj->que_id);
                    $question->setIntitule($obj->que_intitule);
                    array_push($datas, $question);

                }

         
                return $datas;
            }
                   // Methode qui supprime une question
                  // @param $id int l'id de la question à supprimer

                    public function remove(int $id){
                        return $this->connexion->connexion->query('DELETE FROM question WHERE que_id='.$id);
                    }
        }
?>
