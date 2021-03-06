<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AnalyseTechniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;

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

    #[ORM\OneToMany(mappedBy: 'analysetechnique', targetEntity: Commentaire::class, orphanRemoval: true)]
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }



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

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setAnalysetechnique($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAnalysetechnique() === $this) {
                $commentaire->setAnalysetechnique(null);
            }
        }

        return $this;
    }
}
