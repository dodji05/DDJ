<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 * @Vich\Uploadable
 */
class Equipe
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @Vich\UploadableField(mapping="Equipe", fileNameProperty="photo")
     * @var File
     */
    private $ImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\OneToMany(targetEntity=Dessins::class, mappedBy="auteur")
     */
    private $dessins;

    public function __construct()
    {
        $this->dessins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

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
     * @return Collection|Dessins[]
     */
    public function getDessins(): Collection
    {
        return $this->dessins;
    }

    public function addDessin(Dessins $dessin): self
    {
        if (!$this->dessins->contains($dessin)) {
            $this->dessins[] = $dessin;
            $dessin->setAuteur($this);
        }

        return $this;
    }

    public function removeDessin(Dessins $dessin): self
    {
        if ($this->dessins->removeElement($dessin)) {
            // set the owning side to null (unless already changed)
            if ($dessin->getAuteur() === $this) {
                $dessin->setAuteur(null);
            }
        }

        return $this;
    }
}
