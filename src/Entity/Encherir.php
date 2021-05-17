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
     * @ORM\ManyToMany(targetEntity=Acheteur::class, inversedBy="encherirs")
     */
    private $idAcheteur;

    /**
     * @ORM\ManyToMany(targetEntity=Lot::class, inversedBy="encherirs")
     */
    private $idLot;

    public function __construct()
    {
        $this->idAcheteur = new ArrayCollection();
        $this->idLot = new ArrayCollection();
    }
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

    /**
     * @return Collection|Acheteur[]
     */
    public function getIdAcheteur(): Collection
    {
        return $this->idAcheteur;
    }

    public function addIdAcheteur(Acheteur $idAcheteur): self
    {
        if (!$this->idAcheteur->contains($idAcheteur)) {
            $this->idAcheteur[] = $idAcheteur;
        }

        return $this;
    }

    public function removeIdAcheteur(Acheteur $idAcheteur): self
    {
        $this->idAcheteur->removeElement($idAcheteur);

        return $this;
    }

    /**
     * @return Collection|Lot[]
     */
    public function getIdLot(): Collection
    {
        return $this->idLot;
    }

    public function addIdLot(Lot $idLot): self
    {
        if (!$this->idLot->contains($idLot)) {
            $this->idLot[] = $idLot;
        }

        return $this;
    }

    public function removeIdLot(Lot $idLot): self
    {
        $this->idLot->removeElement($idLot);

        return $this;
    }
}
