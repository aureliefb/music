<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StyleRepository::class)]
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $style = null;

    #[ORM\OneToMany(mappedBy: 'style', targetEntity: Artists::class)]
    private Collection $artist;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return Collection<int, Artists>
     */
    public function getArtist(): Collection
    {
        return $this->artist;
    }

    public function addArtist(Artists $artist): self
    {
        if (!$this->artist->contains($artist)) {
            $this->artist->add($artist);
            $artist->setStyle($this);
        }
        return $this;
    }

    public function removeArtist(Artists $artist): self
    {
        if ($this->artist->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getStyle() === $this) {
                $artist->setStyle(null);
            }
        }
        return $this;
    }
}
