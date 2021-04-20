<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
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
     * @ORM\Column(type="string", length=50)
     */
    private $artiste;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $style;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLot;

    /**
     * @ORM\OneToOne(targetEntity=Photo::class, cascade={"persist", "remove"})
     */
    private $idPhoto;

    /**
     * @ORM\ManyToOne(targetEntity=Acheteur::class)
     */
    private $idAcheteur;

    /**
     * @ORM\ManyToOne(targetEntity=Vendeur::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idVendeur;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="produits")
     */
    private $idCategorie;


    /**
     * @ORM\OneToMany(targetEntity=Estimation::class, mappedBy="idProduit")
     */
    private $estimations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    public function __construct()
    {
        $this->idCategorie = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }


    public function getIdLot(): ?Lot
    {
        return $this->idLot;
    }

    public function setIdLot(?Lot $idLot): self
    {
        $this->idLot = $idLot;

        return $this;
    }

    public function getIdPhoto(): ?Photo
    {
        return $this->idPhoto;
    }

    public function setIdPhoto(?Photo $idPhoto): self
    {
        $this->idPhoto = $idPhoto;

        return $this;
    }

    public function getIdAcheteur(): ?Acheteur
    {
        return $this->idAcheteur;
    }

    public function setIdAcheteur(?Acheteur $idAcheteur): self
    {
        $this->idAcheteur = $idAcheteur;

        return $this;
    }

    public function getIdVendeur(): ?Vendeur
    {
        return $this->idVendeur;
    }

    public function setIdVendeur(?Vendeur $idVendeur): self
    {
        $this->idVendeur = $idVendeur;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getIdCategorie(): Collection
    {
        return $this->idCategorie;
    }

    public function addIdCategorie(Categorie $idCategorie): self
    {
        if (!$this->idCategorie->contains($idCategorie)) {
            $this->idCategorie[] = $idCategorie;
        }

        return $this;
    }

    public function removeIdCategorie(Categorie $idCategorie): self
    {
        $this->idCategorie->removeElement($idCategorie);

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
            $estimation->setIdProduit($this);
        }

        return $this;
    }

    public function removeEstimation(Estimation $estimation): self
    {
        if ($this->estimations->removeElement($estimation)) {
            // set the owning side to null (unless already changed)
            if ($estimation->getIdProduit() === $this) {
                $estimation->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }
}
