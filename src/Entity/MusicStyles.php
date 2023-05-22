<?php

namespace App\Entity;

use App\Repository\MusicStylesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MusicStylesRepository::class)]
#[UniqueEntity('music_style')]
class MusicStyles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_music_styles = null;

    #[ORM\Column(length: 255)]
    private ?string $music_style = null;

    public function getId(): ?int
    {
        return $this->id_music_styles;
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
