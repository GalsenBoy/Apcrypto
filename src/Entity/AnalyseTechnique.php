<?php

namespace App\Entity;

use App\Repository\AnalyseTechniqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalyseTechniqueRepository::class)]
class AnalyseTechnique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $actif;

    #[ORM\Column(type: 'string', length: 255)]
    private $analyse;

    #[ORM\Column(type: 'text')]
    private $explication;

    #[ORM\Column(type: 'datetime')]
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActif(): ?string
    {
        return $this->actif;
    }

    public function setActif(string $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getAnalyse(): ?string
    {
        return $this->analyse;
    }

    public function setAnalyse(string $analyse): self
    {
        $this->analyse = $analyse;

        return $this;
    }

    public function getExplication(): ?string
    {
        return $this->explication;
    }

    public function setExplication(string $explication): self
    {
        $this->explication = $explication;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
