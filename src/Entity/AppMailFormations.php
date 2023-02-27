<?php

namespace App\Entity;

use App\Repository\AppMailFormationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppMailFormationsRepository::class)]
class AppMailFormations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $appMail_formations_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppMailFormationsName(): ?string
    {
        return $this->appMail_formations_name;
    }

    public function setAppMailFormationsName(string $appMail_formations_name): self
    {
        $this->appMail_formations_name = $appMail_formations_name;

        return $this;
    }
}
