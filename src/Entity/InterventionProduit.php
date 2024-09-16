<?php

namespace App\Entity;

use App\Repository\InterventionProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InterventionProduitRepository::class)]
class InterventionProduit
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'interventionProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'interventionProduits')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["get_produit", "get_intervention"])]
    private ?Interventions $intervention = null;

    #[ORM\Column]
    #[Groups(["get_produit", "get_intervention"])]
    private ?int $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(["get_produit", "get_intervention"])]
    private ?string $prix = null;

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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
