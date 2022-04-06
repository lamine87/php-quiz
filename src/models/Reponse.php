<?php

namespace models;

class Reponse
{
    /* 
     *  PROPRIETE
     */
    private $id;
    private $texte;
    private $isTrue;

    /**
     * Get /*
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set /*
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of texte
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set the value of texte
     *
     * @return  self
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get the value of isTrue
     */
    public function getIsTrue()
    {
        return $this->isTrue;
    }

    /**
     * Set the value of isTrue
     *
     * @return  self
     */
    public function setIsTrue($isTrue)
    {
        $this->isTrue = $isTrue;

        return $this;
    }
}
