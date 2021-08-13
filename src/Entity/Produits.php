<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 * @Vich\Uploadable
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImagesPrincipales;

    /**
     * @Vich\UploadableField(mapping="Produits", fileNameProperty="ImagesPrincipales")
     * @var File
     */
    private $ImageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Updated_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $featured;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;


    /**
     * @ORM\ManyToOne(targetEntity=CategorieProduits::class, inversedBy="produits")
     */
    private $Categorie;

    /**
     * @ORM\OneToMany(targetEntity=LignesCommande::class, mappedBy="produit")
     */
    private $lignesCommandes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlLiseuse;

    /**
     * @ORM\OneToMany(targetEntity=ProduitsVariants::class, mappedBy="produits")
     */
    private $produitsVariants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * Produits constructor.
     */
    public function __construct()
    {

    $this->setFeatured(true);

    $this->lignesCommandes = new ArrayCollection();
    $this->produitsVariants = new ArrayCollection();
    $this->Date = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getImagesPrincipales(): ?string
    {
        return $this->ImagesPrincipales;
    }

    public function setImagesPrincipales(?string $ImagesPrincipales): self
    {
        $this->ImagesPrincipales = $ImagesPrincipales;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->Created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $Created_at): self
    {
        $this->Created_at = $Created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->Updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $Updated_at): self
    {
        $this->Updated_at = $Updated_at;

        return $this;
    }

    public function getFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(?bool $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }





    public function getCategorie(): ?CategorieProduits
    {
        return $this->Categorie;
    }

    public function setCategorie(?CategorieProduits $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->ImageFile = $image;

//        if ($image) {
//            $this->updated_at = new \DateTime('now');
//        }
    }

    public function getImageFile()
    {
        return $this->ImageFile;
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
            $lignesCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLignesCommande(LignesCommande $lignesCommande): self
    {
        if ($this->lignesCommandes->contains($lignesCommande)) {
            $this->lignesCommandes->removeElement($lignesCommande);
            // set the owning side to null (unless already changed)
            if ($lignesCommande->getProduit() === $this) {
                $lignesCommande->setProduit(null);
            }
        }

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

    /**
     * @return Collection|ProduitsVariants[]
     */
    public function getProduitsVariants(): Collection
    {
        return $this->produitsVariants;
    }

    public function addProduitsVariant(ProduitsVariants $produitsVariant): self
    {
        if (!$this->produitsVariants->contains($produitsVariant)) {
            $this->produitsVariants[] = $produitsVariant;
            $produitsVariant->setProduits($this);
        }

        return $this;
    }

    public function removeProduitsVariant(ProduitsVariants $produitsVariant): self
    {
        if ($this->produitsVariants->removeElement($produitsVariant)) {
            // set the owning side to null (unless already changed)
            if ($produitsVariant->getProduits() === $this) {
                $produitsVariant->setProduits(null);
            }
        }

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
}
