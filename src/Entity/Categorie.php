<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Forfait::class, mappedBy="categorie")
     */
    private $forfaits;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function __construct()
    {
        $this->forfaits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Forfait[]
     */
    public function getForfaits(): Collection
    {
        return $this->forfaits;
    }

    public function addForfait(Forfait $forfait): self
    {
        if (!$this->forfaits->contains($forfait)) {
            $this->forfaits[] = $forfait;
            $forfait->setCategorie($this);
        }

        return $this;
    }

    public function removeForfait(Forfait $forfait): self
    {
        if ($this->forfaits->removeElement($forfait)) {
            // set the owning side to null (unless already changed)
            if ($forfait->getCategorie() === $this) {
                $forfait->setCategorie(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
