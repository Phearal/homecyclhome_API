<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $modified_at = null;

    /**
     * @var Collection<int, InterventionProduit>
     */
    #[ORM\OneToMany(targetEntity: InterventionProduit::class, mappedBy: 'produit')]
    private Collection $interventionProduits;

    public function __construct()
    {
        $this->interventionProduits = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setDateValues(): void
    {
        $timezone = new \DateTimeZone('Europe/Paris');
        $this->created_at = new \DateTimeImmutable('now', $timezone);
        $this->modified_at = new \DateTime('now', $timezone);
    }

    #[ORM\PreUpdate]
    public function setModifiedAtValue(): void
    {
        $timezone = new \DateTimeZone('Europe/Paris');
        $this->modified_at = new \DateTime('now', $timezone);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeInterface $modified_at): static
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    /**
     * @return Collection<int, InterventionProduit>
     */
    public function getInterventionProduits(): Collection
    {
        return $this->interventionProduits;
    }

    public function addInterventionProduit(InterventionProduit $interventionProduit): static
    {
        if (!$this->interventionProduits->contains($interventionProduit)) {
            $this->interventionProduits->add($interventionProduit);
            $interventionProduit->setProduit($this);
        }

        return $this;
    }

    public function removeInterventionProduit(InterventionProduit $interventionProduit): static
    {
        if ($this->interventionProduits->removeElement($interventionProduit)) {
            // set the owning side to null (unless already changed)
            if ($interventionProduit->getProduit() === $this) {
                $interventionProduit->setProduit(null);
            }
        }

        return $this;
    }
}
