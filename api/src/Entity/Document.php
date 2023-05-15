<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getDocument"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getDocument"])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getDocument"])]
    private ?string $author = null;

    #[ORM\Column]
    #[Groups(["getDocument"])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToMany(targetEntity: Level::class, inversedBy: 'documents')]
    private Collection $level;

    #[ORM\ManyToMany(targetEntity: Degree::class, inversedBy: 'documents')]
    private Collection $degree;

    #[ORM\ManyToMany(targetEntity: Pathway::class, inversedBy: 'documents')]
    private Collection $pathway;

    public function __construct()
    {
        $this->level = new ArrayCollection();
        $this->degree = new ArrayCollection();
        $this->pathway = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Level>
     */
    public function getLevel(): Collection
    {
        return $this->level;
    }

    public function addLevel(Level $level): self
    {
        if (!$this->level->contains($level)) {
            $this->level->add($level);
        }

        return $this;
    }

    public function removeLevel(Level $level): self
    {
        $this->level->removeElement($level);

        return $this;
    }

    /**
     * @return Collection<int, Degree>
     */
    public function getDegree(): Collection
    {
        return $this->degree;
    }

    public function addDegree(Degree $degree): self
    {
        if (!$this->degree->contains($degree)) {
            $this->degree->add($degree);
        }

        return $this;
    }

    public function removeDegree(Degree $degree): self
    {
        $this->degree->removeElement($degree);

        return $this;
    }

    /**
     * @return Collection<int, Pathway>
     */
    public function getPathway(): Collection
    {
        return $this->pathway;
    }

    public function addPathway(Pathway $Pathway): self
    {
        if (!$this->pathway->contains($Pathway)) {
            $this->pathway->add($Pathway);
        }

        return $this;
    }

    public function removePathway(Pathway $Pathway): self
    {
        $this->pathway->removeElement($Pathway);

        return $this;
    }
}
