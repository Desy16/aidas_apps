<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticuliersRepository")
 */
class Particuliers
{
    const CHOIX = 'choix';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    # Assert\Choice({"--Veuillez choisir un sinistre--"}, message="Choisissez un sinistre valide")
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $sinistre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSinistre(): ?string
    {
        return $this->sinistre;
    }

    public function setSinistre(string $sinistre): self
    {
        $this->sinistre = $sinistre;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }
}
