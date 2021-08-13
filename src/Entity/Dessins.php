<?php

namespace App\Entity;

use App\Repository\DessinsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DessinsRepository::class)
 *  @Vich\Uploadable
 */
class Dessins
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @Vich\UploadableField(mapping="Dessins", fileNameProperty="images")
     * @var File
     */
    private $ImageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="dessins")
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getAuteur(): ?Equipe
    {
        return $this->auteur;
    }

    public function setAuteur(?Equipe $auteur): self
    {
        $this->auteur = $auteur;

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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

}
