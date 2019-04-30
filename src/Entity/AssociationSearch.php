<?php

namespace App\Entity;


class AssociationSearch {

    /**
     * @var string
     */ 
    private $commune;

    /**
     * Get the value of commune
     */ 
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set the value of commune
     *
     * @return  self
     */ 
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }
}

?>