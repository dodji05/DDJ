<?php

namespace App\Entity;

use App\Repository\CommandeAbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeAbonnementRepository::class)
 */
class CommandeAbonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateAbonnement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandeAbonnements")
     */
    private $user;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\OneToMany(targetEntity=LignesCommandeAbonnement::class, mappedBy="commandeAbonnement")
     */
    private $lignesCommandeAbonnements;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeAbonnement;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbreNumeroRestant;

    public function __construct()
    {
        $this->lignesCommandeAbonnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAbonnement(): ?\DateTimeInterface
    {
        return $this->dateAbonnement;
    }

    public function setDateAbonnement(?\DateTimeInterface $dateAbonnement): self
    {
        $this->dateAbonnement = $dateAbonnement;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

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
            $lignesCommandeAbonnement->setCommandeAbonnement($this);
        }

        return $this;
    }

    public function removeLignesCommandeAbonnement(LignesCommandeAbonnement $lignesCommandeAbonnement): self
    {
        if ($this->lignesCommandeAbonnements->removeElement($lignesCommandeAbonnement)) {
            // set the owning side to null (unless already changed)
            if ($lignesCommandeAbonnement->getCommandeAbonnement() === $this) {
                $lignesCommandeAbonnement->setCommandeAbonnement(null);
            }
        }

        return $this;
    }

    public function getTypeAbonnement(): ?string
    {
        return $this->typeAbonnement;
    }

    public function setTypeAbonnement(?string $typeAbonnement): self
    {
        $this->typeAbonnement = $typeAbonnement;

        return $this;
    }

    public function getNbreNumeroRestant(): ?int
    {
        return $this->NbreNumeroRestant;
    }

    public function setNbreNumeroRestant(?int $NbreNumeroRestant): self
    {
        $this->NbreNumeroRestant = $NbreNumeroRestant;

        return $this;
    }
}
