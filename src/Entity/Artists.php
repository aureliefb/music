<?php

namespace App\Entity;

use App\Repository\ArtistsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ArtistsRepository::class)]
#[UniqueEntity('artist')]
class Artists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $artist = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $id_music_styles = null;

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
}
