<?php

namespace App\Entity;

use App\Repository\LignesCommandeAbonnementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LignesCommandeAbonnementRepository::class)
 */
class LignesCommandeAbonnement
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dure;

    /**
     * @ORM\ManyToOne(targetEntity=DetailsAbonnement::class, inversedBy="lignesCommandeAbonnements")
     */
    private $abonnement;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeAbonnement::class, inversedBy="lignesCommandeAbonnements")
     */
    private $commandeAbonnement;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDure(): ?string
    {
        return $this->dure;
    }

    public function setDure(?string $dure): self
    {
        $this->dure = $dure;

        return $this;
    }

    public function getAbonnement(): ?DetailsAbonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?DetailsAbonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    public function getCommandeAbonnement(): ?CommandeAbonnement
    {
        return $this->commandeAbonnement;
    }

    public function setCommandeAbonnement(?CommandeAbonnement $commandeAbonnement): self
    {
        $this->commandeAbonnement = $commandeAbonnement;

        return $this;
    }
}
