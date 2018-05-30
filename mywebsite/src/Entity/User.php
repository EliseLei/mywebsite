<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Playlist", mappedBy="id_user")
     */
    private $id_playlist;

    public function __construct()
    {
        $this->id_playlist = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    /**
     * @return Collection|Playlist[]
     */
    public function getIdPlaylist(): Collection
    {
        return $this->id_playlist;
    }

    public function addIdPlaylist(Playlist $idPlaylist): self
    {
        if (!$this->id_playlist->contains($idPlaylist)) {
            $this->id_playlist[] = $idPlaylist;
            $idPlaylist->setIdUser($this);
        }

        return $this;
    }

    public function removeIdPlaylist(Playlist $idPlaylist): self
    {
        if ($this->id_playlist->contains($idPlaylist)) {
            $this->id_playlist->removeElement($idPlaylist);
            // set the owning side to null (unless already changed)
            if ($idPlaylist->getIdUser() === $this) {
                $idPlaylist->setIdUser(null);
            }
        }

        return $this;
    }
}
