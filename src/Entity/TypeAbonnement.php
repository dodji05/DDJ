<?php

namespace App\Entity;

use App\Repository\TypeAbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeAbonnementRepository::class)
 */
class TypeAbonnement
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
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity=DetailsAbonnement::class, mappedBy="typeabonnement")
     */
    private $detailsAbonnements;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    public function __construct()
    {
        $this->detailsAbonnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection|DetailsAbonnement[]
     */
    public function getDetailsAbonnements(): Collection
    {
        return $this->detailsAbonnements;
    }

    public function addDetailsAbonnement(DetailsAbonnement $detailsAbonnement): self
    {
        if (!$this->detailsAbonnements->contains($detailsAbonnement)) {
            $this->detailsAbonnements[] = $detailsAbonnement;
            $detailsAbonnement->setTypeabonnement($this);
        }

        return $this;
    }

    public function removeDetailsAbonnement(DetailsAbonnement $detailsAbonnement): self
    {
        if ($this->detailsAbonnements->removeElement($detailsAbonnement)) {
            // set the owning side to null (unless already changed)
            if ($detailsAbonnement->getTypeabonnement() === $this) {
                $detailsAbonnement->setTypeabonnement(null);
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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }
}
