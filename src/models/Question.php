<?php 

    namespace models;
    class Question{
        
        /* 
        PROPRIETE
        */
        private $id;
        private $intitule;
        private $reponses = [];
        /* 
         * Constructeur
        */
        public function __construct(){
                $this->reponses = [];
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of intitule
         */ 
        public function getIntitule()
        {
                return $this->intitule;
        }

        /**
         * Set the value of intitule
         *
         * @return  self
         */ 
        public function setIntitule($intitule)
        {
                $this->intitule = $intitule;

                return $this;
        }

        public function addReponse($reponse){
                array_push($this->reponses, $reponse);
        }
        /**
         * Get the value of reponses
         */ 
        public function getReponses()
        {
                return $this->reponses;
        }

        /**
         * Set the value of reponses
         *
         * @return  self
         */ 
        public function setReponses($reponses)
        {
                $this->reponses = $reponses;

                return $this;
        }
    }
