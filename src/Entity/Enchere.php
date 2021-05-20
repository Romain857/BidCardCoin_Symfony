<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnchereRepository::class)
 */
class Enchere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heureFin;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\OneToMany(targetEntity=Lieu::class, mappedBy="enchere")
     */
    private $idLieu;

    /**
     * @ORM\OneToMany(targetEntity=Admin::class, mappedBy="enchere")
     */
    private $idAdmin;

    /**
     * @ORM\OneToMany(targetEntity=Lot::class, mappedBy="idEnchere")
     */
    private $lots;

    public function __construct()
    {
        $this->idLieu = new ArrayCollection();
        $this->idAdmin = new ArrayCollection();
        $this->lots = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)($this->getNom());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection|Lieu[]
     */
    public function getIdLieu(): Collection
    {
        return $this->idLieu;
    }

    public function addIdLieu(Lieu $idLieu): self
    {
        if (!$this->idLieu->contains($idLieu)) {
            $this->idLieu[] = $idLieu;
            $idLieu->setEnchere($this);
        }

        return $this;
    }

    public function removeIdLieu(Lieu $idLieu): self
    {
        if ($this->idLieu->removeElement($idLieu)) {
            // set the owning side to null (unless already changed)
            if ($idLieu->getEnchere() === $this) {
                $idLieu->setEnchere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Admin[]
     */
    public function getIdAdmin(): Collection
    {
        return $this->idAdmin;
    }

    public function addIdAdmin(Admin $idAdmin): self
    {
        if (!$this->idAdmin->contains($idAdmin)) {
            $this->idAdmin[] = $idAdmin;
            $idAdmin->setEnchere($this);
        }

        return $this;
    }

    public function removeIdAdmin(Admin $idAdmin): self
    {
        if ($this->idAdmin->removeElement($idAdmin)) {
            // set the owning side to null (unless already changed)
            if ($idAdmin->getEnchere() === $this) {
                $idAdmin->setEnchere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lot[]
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(Lot $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots[] = $lot;
            $lot->setIdEnchere($this);
        }

        return $this;
    }

    public function removeLot(Lot $lot): self
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getIdEnchere() === $this) {
                $lot->setIdEnchere(null);
            }
        }

        return $this;
    }
}
