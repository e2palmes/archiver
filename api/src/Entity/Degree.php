<?php

namespace App\Entity;

use App\Repository\DegreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DegreeRepository::class)]
class Degree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getDegree'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getDegree'])]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Document::class, mappedBy: 'degree', orphanRemoval: true)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'degree', targetEntity: Pathway::class)]
    private Collection $pathways;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->pathways = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->addDegree($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            $document->removeDegree($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Pathway>
     */
    public function getPathways(): Collection
    {
        return $this->pathways;
    }

    public function addPathway(Pathway $option): self
    {
        if (!$this->pathways->contains($option)) {
            $this->pathways->add($option);
            $option->setDegree($this);
        }

        return $this;
    }

    public function removeOption(Pathway $option): self
    {
        if ($this->pathways->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getDegree() === $this) {
                $option->setDegree(null);
            }
        }

        return $this;
    }
}
