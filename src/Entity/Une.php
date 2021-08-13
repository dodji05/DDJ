<?php

namespace App\Entity;

use App\Repository\UneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UneRepository::class)
 * @Vich\Uploadable
 */
class Une
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
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImagesUne;

    /**
     * @Vich\UploadableField(mapping="LaUne", fileNameProperty="ImagesUne")
     * @var File
     */
    private $ImagesDeLaUne;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Created_At;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Update_At;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Created_by;


    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->Numero;
    }

    public function setNumero(?string $Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getImagesUne(): ?string
    {
        return $this->ImagesUne;
    }

    public function setImagesUne(?string $ImagesUne): self
    {
        $this->ImagesUne = $ImagesUne;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->Created_At;
    }

    public function setCreatedAt(?\DateTimeInterface $Created_At): self
    {
        $this->Created_At = $Created_At;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->Update_At;
    }

    public function setUpdateAt(?\DateTimeInterface $Update_At): self
    {
        $this->Update_At = $Update_At;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->Created_by;
    }

    public function setCreatedBy(?string $Created_by): self
    {
        $this->Created_by = $Created_by;

        return $this;
    }


    public function setImagesDeLaUne(File $image = null)
    {
        $this->ImagesDeLaUne = $image;

//        if ($image) {
//            $this->updated_at = new \DateTime('now');
//        }
    }

    public function getImagesDeLaUne()
    {
        return $this->ImagesDeLaUne;
    }
}
