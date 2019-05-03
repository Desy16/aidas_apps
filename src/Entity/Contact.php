<?php 

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @var String|null
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=100)
     */
    private $nom;

    /**
     * @var String|null
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=100)
     */
    private $prenom;

    /**
     * @var String|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/[0-9]{10}/"
     * )
     */
    private $tel;

     /**
     * @var String|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var String|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;
    
    /**
     * @var Association|null
     */
    private $association;


    /**
     * Get the value of nom
     *
     * @return  String|null
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  String|null  $nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return  String|null
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param  String|null  $prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get pattern="/[0-9]{10}/"
     *
     * @return  String|null
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set pattern="/[0-9]{10}/"
     *
     * @param  String|null  $tel  pattern="/[0-9]{10}/"
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  String|null
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  String|null  $email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  String|null
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  String|null  $message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of association
     *
     * @return  Association|null
     */ 
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set the value of association
     *
     * @param  Association|null  $association
     *
     * @return  self
     */ 
    public function setAssociation($association)
    {
        $this->association = $association;

        return $this;
    }
}
?>