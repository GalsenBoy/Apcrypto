<?php

namespace App\Entity;

use App\Repository\CommentaireFondaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireFondaRepository::class)]
class CommentaireFonda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $actifFonda;

    #[ORM\Column(type: 'text')]
    private $ContenuFonda;

    #[ORM\Column(type: 'string', length: 255)]
    private $nickname;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\ManyToOne(targetEntity: AnalyseFondamentale::class, inversedBy: 'commentaireFondas')]
    #[ORM\JoinColumn(nullable: false)]
    private $analyseFondamentale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActifFonda(): ?string
    {
        return $this->actifFonda;
    }

    public function setActifFonda(?string $actifFonda): self
    {
        $this->actifFonda = $actifFonda;

        return $this;
    }

    public function getContenuFonda(): ?string
    {
        return $this->ContenuFonda;
    }

    public function setContenuFonda(string $ContenuFonda): self
    {
        $this->ContenuFonda = $ContenuFonda;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

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

    public function getAnalyseFondamentale(): ?AnalyseFondamentale
    {
        return $this->analyseFondamentale;
    }

    public function setAnalyseFondamentale(?AnalyseFondamentale $analyseFondamentale): self
    {
        $this->analyseFondamentale = $analyseFondamentale;

        return $this;
    }
}
