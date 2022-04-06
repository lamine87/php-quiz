<?php 

    namespace models;
    class Question{
        
        /* 
        PROPRIETE
        */
        private $id;
        private $intitule;



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
    }
?>
