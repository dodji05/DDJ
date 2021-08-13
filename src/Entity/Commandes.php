<?php

namespace App\Entity;

//use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 *
 */
class Commandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateCommande;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Client;

    /**
     * @ORM\Column(type="string", length=75, nullable=true)
     */
    private $Etat;

    /**
     * @ORM\OneToMany(targetEntity=LignesCommande::class, mappedBy="commande")
     */
    private $lignesCommandes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     */
    private $user;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;



    public function __construct()
    {
        $this->lignesCommandes = new ArrayCollection();
        $this->DateCommande = new  \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->DateCommande;
    }

    public function setDateCommande(?\DateTimeInterface $DateCommande): self
    {
        $this->DateCommande = $DateCommande;

        return $this;
    }

    public function getClient(): ?int
    {
        return $this->Client;
    }

    public function setClient(?int $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(?string $Etat): self
    {
        $this->Etat = $Etat;

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
            $lignesCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLignesCommande(LignesCommande $lignesCommande): self
    {
        if ($this->lignesCommandes->contains($lignesCommande)) {
            $this->lignesCommandes->removeElement($lignesCommande);
            // set the owning side to null (unless already changed)
            if ($lignesCommande->getCommande() === $this) {
                $lignesCommande->setCommande(null);
            }
        }

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
