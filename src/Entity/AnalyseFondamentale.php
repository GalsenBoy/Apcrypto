<?php

namespace App\Entity;

use App\Repository\AnalyseFondamentaleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'analyseFondamentale', targetEntity: CommentaireFonda::class, orphanRemoval: true)]
    private $commentaireFondas;

    public function __construct()
    {
        $this->commentaireFondas = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, CommentaireFonda>
     */
    public function getCommentaireFondas(): Collection
    {
        return $this->commentaireFondas;
    }

    public function addCommentaireFonda(CommentaireFonda $commentaireFonda): self
    {
        if (!$this->commentaireFondas->contains($commentaireFonda)) {
            $this->commentaireFondas[] = $commentaireFonda;
            $commentaireFonda->setAnalyseFondamentale($this);
        }

        return $this;
    }

    public function removeCommentaireFonda(CommentaireFonda $commentaireFonda): self
    {
        if ($this->commentaireFondas->removeElement($commentaireFonda)) {
            // set the owning side to null (unless already changed)
            if ($commentaireFonda->getAnalyseFondamentale() === $this) {
                $commentaireFonda->setAnalyseFondamentale(null);
            }
        }

        return $this;
    }
}
