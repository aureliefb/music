<?php

namespace App\Entity;

use App\Repository\MusicStylesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicStylesRepository::class)]
class MusicStyles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $music_style = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusicStyle(): ?string
    {
        return $this->music_style;
    }

    public function setMusicStyle(string $music_style): self
    {
        $this->music_style = $music_style;

        return $this;
    }
}
