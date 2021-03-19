<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VendeurRepository::class)
 */
class Vendeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Personne::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPersonne;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="idVendeur")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)($this->getIdPersonne());
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $produit->setIdVendeur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getIdVendeur() === $this) {
                $produit->setIdVendeur(null);
            }
        }

        return $this;
    }
}
