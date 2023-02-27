<?php

namespace App\Entity;

use App\Repository\AppMailContactsRepository;
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
}
