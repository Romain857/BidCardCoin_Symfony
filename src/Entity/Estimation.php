<?php

namespace App\Entity;

use App\Repository\EstimationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstimationRepository::class)
 */
class Estimation
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
    private $estimation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEstimation;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="estimations")
     */
    private $idProduit;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="estimations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAdmin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstimation(): ?float
    {
        return $this->estimation;
    }

    public function setEstimation(float $estimation): self
    {
        $this->estimation = $estimation;

        return $this;
    }

    public function getDateEstimation(): ?\DateTimeInterface
    {
        return $this->dateEstimation;
    }

    public function setDateEstimation(\DateTimeInterface $dateEstimation): self
    {
        $this->dateEstimation = $dateEstimation;

        return $this;
    }

    public function __toString()
    {
        return (string)($this->getNom());
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getIdAdmin(): ?Admin
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(?Admin $idAdmin): self
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }
}
