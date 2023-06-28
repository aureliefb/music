<?php

namespace App\Entity;

use App\Repository\ArtistsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArtistsRepository::class)]
#[UniqueEntity('artist')]
//#[Vich\Uploadable]
class Artists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true, length: 255)]
    private ?string $filename = null;

    //#[Vich\UploadableField(mapping: 'artists_img', fileNameProperty: 'filename')]
    //private ?File $imageFile = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $artist = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $id_music_styles = null;

    /*#[ORM\Column]
    private ?DateTime $updated_at = null;*/

    #[ORM\Column(nullable: true)]
    private ?int $id_style = null;

    #[ORM\ManyToOne(inversedBy: 'artists', targetEntity: MusicStyles::class)]
    #[ORM\JoinColumn(nullable: false, name:'id_music_styles', referencedColumnName:'id_music_styles')]
    private ?MusicStyles $style = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;
        return $this;
    }

    public function getIdMusicStyles(): ?string
    {
        return $this->id_music_styles;
    }

    public function setIdMusicStyles(string $id_music_styles): self
    {
        $this->id_music_styles = $id_music_styles;
        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    /*public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTimeImmutable('now');
        }
        return $this;
    }*/

    /*public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }*/

    public function getIdStyle(): ?int
    {
        return $this->id_style;
    }

    public function setIdStyle(?int $id_style): self
    {
        $this->id_style = $id_style;
        return $this;
    }

    public function getStyle(): ?MusicStyles
    {
        return $this->style;
    }

    public function setStyle(?MusicStyles $style): self
    {
        $this->style = $style;
        return $this;
    }



}
