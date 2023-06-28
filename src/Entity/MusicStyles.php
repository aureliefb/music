<?php

namespace App\Entity;

use App\Repository\MusicStylesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'style', targetEntity: Artists::class)]
    private Collection $artists;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Artists>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artists $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->setStyle($this);
        }

        return $this;
    }

    public function removeArtist(Artists $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getStyle() === $this) {
                $artist->setStyle(null);
            }
        }

        return $this;
    }
}
