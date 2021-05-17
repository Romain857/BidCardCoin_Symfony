<?php

namespace App\Entity;

use App\Repository\LotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotRepository::class)
 */
class Lot
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Enchere::class, inversedBy="lots")
     */
    private $idEnchere;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="idLot")
     */
    private $produits;

    /**
     * @ORM\OneToMany (targetEntity=Encherir::class, mappedBy="idLot")
     */
    private $encherirs;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $estimationActuelle;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixVente;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixReserve;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEstimation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateVente;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->encherirs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdEnchere(): ?Enchere
    {
        return $this->idEnchere;
    }

    public function setIdEnchere(?Enchere $idEnchere): self
    {
        $this->idEnchere = $idEnchere;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setIdLot($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getIdLot() === $this) {
                $produit->setIdLot(null);
            }
        }

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
            $encherir->setIdLot($this);
        }

        return $this;
    }

    public function removeEncherir(Encherir $encherir): self
    {
        if ($this->encherirs->removeElement($encherir)) {
            if ($encherir->getIdLot() === $this) {
                $encherir->setIdLot(null);
            }
        }

        return $this;
    }

    public function getEstimationActuelle(): ?float
    {
        return $this->estimationActuelle;
    }

    public function setEstimationActuelle(?float $estimationActuelle): self
    {
        $this->estimationActuelle = $estimationActuelle;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(?float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getPrixReserve(): ?float
    {
        return $this->prixReserve;
    }

    public function setPrixReserve(?float $prixReserve): self
    {
        $this->prixReserve = $prixReserve;

        return $this;
    }

    public function getDateEstimation(): ?\DateTimeInterface
    {
        return $this->dateEstimation;
    }

    public function setDateEstimation(?\DateTimeInterface $dateEstimation): self
    {
        $this->dateEstimation = $dateEstimation;

        return $this;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->dateVente;
    }

    public function setDateVente(?\DateTimeInterface $dateVente): self
    {
        $this->dateVente = $dateVente;

        return $this;
    }
}
