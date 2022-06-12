<?php

namespace App\Entity;

use App\Repository\HoraireconduiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoraireconduiteRepository::class)
 */
class Horaireconduite
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
    private $horaireouverture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horairefermeture;

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

    public function getHoraireouverture(): ?string
    {
        return $this->horaireouverture;
    }

    public function setHoraireouverture(?string $horaireouverture): self
    {
        $this->horaireouverture = $horaireouverture;

        return $this;
    }

    public function getHorairefermeture(): ?string
    {
        return $this->horairefermeture;
    }

    public function setHorairefermeture(?string $horairefermeture): self
    {
        $this->horairefermeture = $horairefermeture;

        return $this;
    }
}
