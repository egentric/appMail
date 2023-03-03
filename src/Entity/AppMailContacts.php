<?php

namespace App\Entity;

use App\Repository\AppMailContactsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: AppMailContactsRepository::class)]
class AppMailContacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $appMail_contacts_email = null;

    #[ORM\Column(length: 255)]
    private ?string $appMail_contacts_firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $appMail_contacts_lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $appMail_contacts_business = null;

    #[ORM\ManyToOne(inversedBy: 'appMailContacts')]
    private ?user $user = null;

    #[ORM\ManyToMany(targetEntity: AppMailCategories::class, inversedBy: 'appMailContacts')]
    private Collection $category;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone = null;


    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppMailContactsEmail(): ?string
    {
        return $this->appMail_contacts_email;
    }

    public function setAppMailContactsEmail(string $appMail_contacts_email): self
    {
        $this->appMail_contacts_email = $appMail_contacts_email;

        return $this;
    }

    public function getAppMailContactsFirstName(): ?string
    {
        return $this->appMail_contacts_firstName;
    }

    public function setAppMailContactsFirstName(string $appMail_contacts_firstName): self
    {
        $this->appMail_contacts_firstName = $appMail_contacts_firstName;

        return $this;
    }

    public function getAppMailContactsLastName(): ?string
    {
        return $this->appMail_contacts_lastName;
    }

    public function setAppMailContactsLastName(string $appMail_contacts_lastName): self
    {
        $this->appMail_contacts_lastName = $appMail_contacts_lastName;

        return $this;
    }

    public function getAppMailContactsBusiness(): ?string
    {
        return $this->appMail_contacts_business;
    }

    public function setAppMailContactsBusiness(?string $appMail_contacts_business): self
    {
        $this->appMail_contacts_business = $appMail_contacts_business;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

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
        }

        return $this;
    }

    public function removeCategory(AppMailCategories $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
