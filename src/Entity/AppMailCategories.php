<?php

namespace App\Entity;

use App\Repository\AppMailCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppMailCategoriesRepository::class)]
class AppMailCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $appMail_categories_name = null;

    #[ORM\ManyToMany(targetEntity: AppMailContacts::class, mappedBy: 'category')]
    private Collection $appMailContacts;

    public function __construct()
    {
        $this->appMailContacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppMailCategoriesName(): ?string
    {
        return $this->appMail_categories_name;
    }

    public function setAppMailCategoriesName(string $appMail_categories_name): self
    {
        $this->appMail_categories_name = $appMail_categories_name;

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
            $appMailContact->addCategory($this);
        }

        return $this;
    }

    public function removeAppMailContact(AppMailContacts $appMailContact): self
    {
        if ($this->appMailContacts->removeElement($appMailContact)) {
            $appMailContact->removeCategory($this);
        }

        return $this;
    }
}
