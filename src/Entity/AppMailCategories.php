<?php

namespace App\Entity;

use App\Repository\AppMailCategoriesRepository;
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
}
