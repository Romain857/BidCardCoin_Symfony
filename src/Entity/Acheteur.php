<?php

namespace App\Entity;

use App\Repository\AcheteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AcheteurRepository::class)
 */
class Acheteur
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
    private $solde;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSolvable;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $identite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $moyenPaiement;

    /**
     * @ORM\OneToOne(targetEntity=Personne::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPersonne;

    /**
     * @ORM\ManyToMany(targetEntity=Encherir::class, mappedBy="idAcheteur")
     */
    private $encherirs;

    public function __construct()
    {
        $this->encherirs = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)($this->getSolde());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getIsSolvable(): ?bool
    {
        return $this->isSolvable;
    }

    public function setIsSolvable(bool $isSolvable): self
    {
        $this->isSolvable = $isSolvable;

        return $this;
    }

    public function getIdentite(): ?string
    {
        return $this->identite;
    }

    public function setIdentite(string $identite): self
    {
        $this->identite = $identite;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(string $moyenPaiement): self
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    public function getIdPersonne(): ?personne
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(personne $idPersonne): self
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    /**
     * @return Collection|Encherir[]
     */
    public function getEncherirs(): Collection
    {
        return $this->encherirs;
    }

    public function addEncherir(Encherir $encherir): self
    {
        if (!$this->encherirs->contains($encherir)) {
            $this->encherirs[] = $encherir;
            $encherir->addIdAcheteur($this);
        }

        return $this;
    }

    public function removeEncherir(Encherir $encherir): self
    {
        if ($this->encherirs->removeElement($encherir)) {
            $encherir->removeIdAcheteur($this);
        }

        return $this;
    }
}
