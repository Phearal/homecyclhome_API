<?php

namespace App\Entity;

use App\Repository\InterventionProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionProduitRepository::class)]
class InterventionProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'interventionProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produit = null;

    #[ORM\ManyToOne(inversedBy: 'interventionProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Interventions $intervention = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getIntervention(): ?Interventions
    {
        return $this->intervention;
    }

    public function setIntervention(?Interventions $intervention): static
    {
        $this->intervention = $intervention;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
