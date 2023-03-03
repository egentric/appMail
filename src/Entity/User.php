<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $users_firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $users_lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $users_center = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AppMailContacts::class)]
    private Collection $appMailContacts;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AppMailCategories::class)]
    private Collection $category;

    public function __construct()
    {
        $this->roles = [self::ROLE_USER];
        $this->appMailContacts = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsersFirstName(): ?string
    {
        return $this->users_firstName;
    }

    public function setUsersFirstName(string $users_firstName): self
    {
        $this->users_firstName = $users_firstName;

        return $this;
    }

    public function getUsersLastName(): ?string
    {
        return $this->users_lastName;
    }

    public function setUsersLastName(string $users_lastName): self
    {
        $this->users_lastName = $users_lastName;

        return $this;
    }

    public function getUsersCenter(): ?string
    {
        return $this->users_center;
    }

    public function setUsersCenter(string $users_center): self
    {
        $this->users_center = $users_center;

        return $this;
    }

    /**
     * @return Collection<int, AppMailContacts>
     */
    public function getAppMailContacts(): Collection
    {
        return $this->appMailContacts;
    }

    public function addAppMailContact(AppMailContacts $appMailContact): self
    {
        if (!$this->appMailContacts->contains($appMailContact)) {
            $this->appMailContacts->add($appMailContact);
            $appMailContact->setUser($this);
        }

        return $this;
    }

    public function removeAppMailContact(AppMailContacts $appMailContact): self
    {
        if ($this->appMailContacts->removeElement($appMailContact)) {
            // set the owning side to null (unless already changed)
            if ($appMailContact->getUser() === $this) {
                $appMailContact->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AppMailCategories>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(AppMailCategories $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(AppMailCategories $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

        return $this;
    }
}
