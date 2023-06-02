<?php

// entité pour formulaire de recherche d'un artiste/groupe

namespace App\Entity;

class ArtistSearch {

	// pas d'ORM dans cette entity car aucun lien avec la bdd

	private $artistName;
    private $musicStyle;

    public function setArtistName(string $artistName): self
    {
        $this->artistName = $artistName;
        return $this;
    }

	public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setMusicStyle(string $musicStyle): self
    {
        $this->musicStyle = $musicStyle;
        return $this;
    }

    public function getMusicStyle(): ?string
    {
        return $this->musicStyle;
    }

    

}