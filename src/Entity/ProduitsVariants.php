<?php

namespace App\Entity;

use App\Repository\ProduitsVariantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsVariantsRepository::class)
 */
class ProduitsVariants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlLiseuse;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="produitsVariants")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=LignesCommande::class, mappedBy="variant")
     */
    private $lignesCommandes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreNumero;

    public function __construct()
    {
        $this->lignesCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUrlLiseuse(): ?string
    {
        return $this->urlLiseuse;
    }

    public function setUrlLiseuse(?string $urlLiseuse): self
    {
        $this->urlLiseuse = $urlLiseuse;

        return $this;
    }

    public function getProduits(): ?Produits
    {
        return $this->produits;
    }

    public function setProduits(?Produits $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    /**
     * @return Collection|LignesCommande[]
     */
    public function getLignesCommandes(): Collection
    {
        return $this->lignesCommandes;
    }

    public function addLignesCommande(LignesCommande $lignesCommande): self
    {
        if (!$this->lignesCommandes->contains($lignesCommande)) {
            $this->lignesCommandes[] = $lignesCommande;
            $lignesCommande->setVariant($this);
        }

        return $this;
    }

    public function removeLignesCommande(LignesCommande $lignesCommande): self
    {
        if ($this->lignesCommandes->removeElement($lignesCommande)) {
            // set the owning side to null (unless already changed)
            if ($lignesCommande->getVariant() === $this) {
                $lignesCommande->setVariant(null);
            }
        }

        return $this;
    }

    public function getDure(): ?int
    {
        return $this->dure;
    }

    public function setDure(?int $dure): self
    {
        $this->dure = $dure;

        return $this;
    }

    public function getNbreNumero(): ?int
    {
        return $this->nbreNumero;
    }

    public function setNbreNumero(?int $nbreNumero): self
    {
        $this->nbreNumero = $nbreNumero;

        return $this;
    }
}
