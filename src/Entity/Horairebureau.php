<?php

namespace App\Entity;

use App\Repository\HorairebureauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorairebureauRepository::class)
 */
class Horairebureau
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
    private $jour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heureouverture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heurefermeture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(?string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureouverture(): ?string
    {
        return $this->heureouverture;
    }

    public function setHeureouverture(?string $heureouverture): self
    {
        $this->heureouverture = $heureouverture;

        return $this;
    }

    public function getHeurefermeture(): ?string
    {
        return $this->heurefermeture;
    }

    public function setHeurefermeture(?string $heurefermeture): self
    {
        $this->heurefermeture = $heurefermeture;

        return $this;
    }
}
