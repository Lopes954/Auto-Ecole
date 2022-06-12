<?php

namespace App\Entity;

use App\Repository\RenseignementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=RenseignementRepository::class)
 */
class Renseignement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *  @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractere",
     *      maxMessage = "Votre nom doit contenir moins de {{ limit }} caractere"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=100)
      * @Assert\Email(
     *     message = "The email '{{ value }}' ce mail n'est pas valide."
     * )
     */

    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
