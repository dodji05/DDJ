<?php

namespace App\Entity;

//use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LignesCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LignesCommandeRepository::class)
 *
 */
class LignesCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="lignesCommandes", cascade={"persist"})
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class, inversedBy="lignesCommandes")
     */
    private $commande;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=ProduitsVariants::class, inversedBy="lignesCommandes")
     */
    private $variant;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commandes
    {
        return $this->commande;
    }

    public function setCommande(?Commandes $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(?float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getVariant(): ?ProduitsVariants
    {
        return $this->variant;
    }

    public function setVariant(?ProduitsVariants $variant): self
    {
        $this->variant = $variant;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }
}
