<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields = {"email"},
 * message = "Le nom d'utilisateur que vous avez choisi existe déjà"
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     * *  @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractere",
     *      maxMessage = "Votre nom doit contenir moins de {{ limit }} caractere"
     * )
     */
    private $username;




    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractere",
     *      maxMessage = "Votre nom doit contenir moins de {{ limit }} caractere"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractere",
     *      maxMessage = "Votre nom doit contenir moins de {{ limit }} caractere"
     * )
     */
    private $prenom;
    
    /**
     * @ORM\Column(type="integer", length=10)
     * @Assert\Length(
     *     
     *      min = 10,
     *      max = 10,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractere",
     *      maxMessage = "Votre nom doit contenir moins de {{ limit }} caractere",
     *      exactMessage = "Vous devez mettre 10 chiffre"
     *      
     * )
     *  @Assert\Regex("/[0-9]/"
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="client", orphanRemoval=true)
     */
    private $calendars;

    public function __construct()
    {
        $this->calendars = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }







    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }




    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getAge(): ?DateTimeInterface
    {
        return $this->age;
    }

    public function setAge(DateTimeInterface $age): self
    {
        $this->age = $age;

        return $this;
    }
    public function __toString()
    {
        return $this->nom.' '.$this->prenom;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getCalendars() : Collection 
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars[] = $calendar;
            $calendar->setClient($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getClient() === $this) {
                $calendar->setClient(null);
            }
        }

        return $this;
    }
}
