<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
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
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroTel;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $motDePasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity=Lieu::class, mappedBy="admin")
     */
    private $idLieu;

    /**
     * @ORM\ManyToOne(targetEntity=Enchere::class, inversedBy="idAdmin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enchere;

    /**
     * @ORM\OneToMany(targetEntity=Estimation::class, mappedBy="idAdmin")
     */
    private $estimations;

    public function __construct()
    {
        $this->idLieu = new ArrayCollection();
        $this->estimations = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(int $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection|lieu[]
     */
    public function getIdLieu(): Collection
    {
        return $this->idLieu;
    }

    public function addIdLieu(lieu $idLieu): self
    {
        if (!$this->idLieu->contains($idLieu)) {
            $this->idLieu[] = $idLieu;
            $idLieu->setAdmin($this);
        }

        return $this;
    }

    public function removeIdLieu(lieu $idLieu): self
    {
        if ($this->idLieu->removeElement($idLieu)) {
            // set the owning side to null (unless already changed)
            if ($idLieu->getAdmin() === $this) {
                $idLieu->setAdmin(null);
            }
        }

        return $this;
    }

    public function getEnchere(): ?Enchere
    {
        return $this->enchere;
    }

    public function setEnchere(?Enchere $enchere): self
    {
        $this->enchere = $enchere;

        return $this;
    }

    /**
     * @return Collection|Estimation[]
     */
    public function getEstimations(): Collection
    {
        return $this->estimations;
    }

    public function addEstimation(Estimation $estimation): self
    {
        if (!$this->estimations->contains($estimation)) {
            $this->estimations[] = $estimation;
            $estimation->setIdAdmin($this);
        }

        return $this;
    }

    public function removeEstimation(Estimation $estimation): self
    {
        if ($this->estimations->removeElement($estimation)) {
            // set the owning side to null (unless already changed)
            if ($estimation->getIdAdmin() === $this) {
                $estimation->setIdAdmin(null);
            }
        }

        return $this;
    }
}
