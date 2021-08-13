<?php

namespace App\Entity;

use App\Repository\DetailsAbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailsAbonnementRepository::class)
 */
class DetailsAbonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Dure;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixUnitaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NBreNumero;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixEuro;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAbonnement::class, inversedBy="detailsAbonnements")
     */
    private $typeabonnement;

    /**
     * @ORM\OneToMany(targetEntity=LignesCommandeAbonnement::class, mappedBy="abonnement")
     */
    private $lignesCommandeAbonnements;

    public function __construct()
    {
        $this->lignesCommandeAbonnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDure(): ?int
    {
        return $this->Dure;
    }

    public function setDure(?int $Dure): self
    {
        $this->Dure = $Dure;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->PrixUnitaire;
    }

    public function setPrixUnitaire(float $PrixUnitaire): self
    {
        $this->PrixUnitaire = $PrixUnitaire;

        return $this;
    }

    public function getNBreNumero(): ?int
    {
        return $this->NBreNumero;
    }

    public function setNBreNumero(?int $NBreNumero): self
    {
        $this->NBreNumero = $NBreNumero;

        return $this;
    }

    public function getPrixEuro(): ?float
    {
        return $this->PrixEuro;
    }

    public function setPrixEuro(?float $PrixEuro): self
    {
        $this->PrixEuro = $PrixEuro;

        return $this;
    }

    public function getTypeabonnement(): ?TypeAbonnement
    {
        return $this->typeabonnement;
    }

    public function setTypeabonnement(?TypeAbonnement $typeabonnement): self
    {
        $this->typeabonnement = $typeabonnement;

        return $this;
    }

    /**
     * @return Collection|LignesCommandeAbonnement[]
     */
    public function getLignesCommandeAbonnements(): Collection
    {
        return $this->lignesCommandeAbonnements;
    }

    public function addLignesCommandeAbonnement(LignesCommandeAbonnement $lignesCommandeAbonnement): self
    {
        if (!$this->lignesCommandeAbonnements->contains($lignesCommandeAbonnement)) {
            $this->lignesCommandeAbonnements[] = $lignesCommandeAbonnement;
            $lignesCommandeAbonnement->setAbonnement($this);
        }

        return $this;
    }

    public function removeLignesCommandeAbonnement(LignesCommandeAbonnement $lignesCommandeAbonnement): self
    {
        if ($this->lignesCommandeAbonnements->removeElement($lignesCommandeAbonnement)) {
            // set the owning side to null (unless already changed)
            if ($lignesCommandeAbonnement->getAbonnement() === $this) {
                $lignesCommandeAbonnement->setAbonnement(null);
            }
        }

        return $this;
    }
}
