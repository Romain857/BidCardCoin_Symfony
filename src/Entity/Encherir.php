<?php

namespace App\Entity;

use App\Repository\EncherirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EncherirRepository::class)
 */
class Encherir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prixPropose;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="encherirs")
     */
    private $idPersonne;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="encherirs")
     */
    private $idLot;

    public function __toString()
    {
        return (string)($this->getPrixPropose());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixPropose(): ?float
    {
        return $this->prixPropose;
    }

    public function setPrixPropose(float $prixPropose): self
    {
        $this->prixPropose = $prixPropose;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getIdPersonne(): ?personne
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(?personne $idPersonne): self
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    public function getIdLot(): ?lot
    {
        return $this->idLot;
    }

    public function setIdLot(?lot $idLot): self
    {
        $this->idLot = $idLot;

        return $this;
    }
}
