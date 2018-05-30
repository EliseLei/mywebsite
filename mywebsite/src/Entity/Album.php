<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artiste;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_single;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Single", mappedBy="id_album")
     */
    private $id_single;

    public function __construct()
    {
        $this->id_single = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getNbSingle(): ?int
    {
        return $this->nb_single;
    }

    public function setNbSingle(int $nb_single): self
    {
        $this->nb_single = $nb_single;

        return $this;
    }

    /**
     * @return Collection|Single[]
     */
    public function getIdSingle(): Collection
    {
        return $this->id_single;
    }

    public function addIdSingle(Single $idSingle): self
    {
        if (!$this->id_single->contains($idSingle)) {
            $this->id_single[] = $idSingle;
            $idSingle->setIdAlbum($this);
        }

        return $this;
    }

    public function removeIdSingle(Single $idSingle): self
    {
        if ($this->id_single->contains($idSingle)) {
            $this->id_single->removeElement($idSingle);
            // set the owning side to null (unless already changed)
            if ($idSingle->getIdAlbum() === $this) {
                $idSingle->setIdAlbum(null);
            }
        }

        return $this;
    }
}
