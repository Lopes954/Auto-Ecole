<?php

namespace App\Entity;

use App\Repository\ForfaitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ForfaitRepository::class)
 */
class Forfait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="forfaits")
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info1;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info2;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info3;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info4;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info5;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info6;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info7;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info8;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info9;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info10;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info11;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info12;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $info13;

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getInfo1(): ?string
    {
        return $this->info1;
    }

    public function setInfo1(?string $info1): self
    {
        $this->info1 = $info1;

        return $this;
    }

    public function getInfo2(): ?string
    {
        return $this->info2;
    }

    public function setInfo2(?string $info2): self
    {
        $this->info2 = $info2;

        return $this;
    }

    public function getInfo3(): ?string
    {
        return $this->info3;
    }

    public function setInfo3(?string $info3): self
    {
        $this->info3 = $info3;

        return $this;
    }

    public function getInfo4(): ?string
    {
        return $this->info4;
    }

    public function setInfo4(?string $info4): self
    {
        $this->info4 = $info4;

        return $this;
    }

    public function getInfo5(): ?string
    {
        return $this->info5;
    }

    public function setInfo5(?string $info5): self
    {
        $this->info5 = $info5;

        return $this;
    }

    public function getInfo6(): ?string
    {
        return $this->info6;
    }

    public function setInfo6(?string $info6): self
    {
        $this->info6 = $info6;

        return $this;
    }

    public function getInfo7(): ?string
    {
        return $this->info7;
    }

    public function setInfo7(?string $info7): self
    {
        $this->info7 = $info7;

        return $this;
    }

    public function getInfo8(): ?string
    {
        return $this->info8;
    }

    public function setInfo8(?string $info8): self
    {
        $this->info8 = $info8;

        return $this;
    }

    public function getInfo9(): ?string
    {
        return $this->info9;
    }

    public function setInfo9(?string $info9): self
    {
        $this->info9 = $info9;

        return $this;
    }

    public function getInfo10(): ?string
    {
        return $this->info10;
    }

    public function setInfo10(?string $info10): self
    {
        $this->info10 = $info10;

        return $this;
    }

    public function getInfo11(): ?string
    {
        return $this->info11;
    }

    public function setInfo11(?string $info11): self
    {
        $this->info11 = $info11;

        return $this;
    }

    public function getInfo12(): ?string
    {
        return $this->info12;
    }

    public function setInfo12(?string $info12): self
    {
        $this->info12 = $info12;

        return $this;
    }

    public function getInfo13(): ?string
    {
        return $this->info13;
    }

    public function setInfo13(?string $info13): self
    {
        $this->info13 = $info13;

        return $this;
    }


}
