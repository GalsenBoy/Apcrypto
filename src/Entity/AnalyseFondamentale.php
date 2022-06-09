<?php

namespace App\Entity;

use App\Repository\AnalyseFondamentaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalyseFondamentaleRepository::class)]
class AnalyseFondamentale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $actifName;

    #[ORM\Column(type: 'text')]
    private $ExpliquationFond;

    #[ORM\Column(type: 'datetime')]
    private $createat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActifName(): ?string
    {
        return $this->actifName;
    }

    public function setActifName(string $actifName): self
    {
        $this->actifName = $actifName;

        return $this;
    }

    public function getExpliquationFond(): ?string
    {
        return $this->ExpliquationFond;
    }

    public function setExpliquationFond(string $ExpliquationFond): self
    {
        $this->ExpliquationFond = $ExpliquationFond;

        return $this;
    }

    public function getCreateat(): ?\DateTimeInterface
    {
        return $this->createat;
    }

    public function setCreateat(\DateTimeInterface $createat): self
    {
        $this->createat = $createat;

        return $this;
    }
}
