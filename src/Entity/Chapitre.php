<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(attributes={"normalization_context"={"groups"={"chapitre"}, "enable_max_depth"=true}})
 * @ORM\Entity(repositoryClass="App\Repository\ChapitreRepository")
 */
class Chapitre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"chapitre"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"chapitre"})
     * @Groups({"cours"})
     * @Groups({"section"})
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cours", inversedBy="chapitres")
     * @Groups({"chapitre"})
     */
    private $Cours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Section", mappedBy="Chapitre", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $sections;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->Cours;
    }

    public function setCours(?Cours $Cours): self
    {
        $this->Cours = $Cours;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setChapitre($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
            // set the owning side to null (unless already changed)
            if ($section->getChapitre() === $this) {
                $section->setChapitre(null);
            }
        }

        return $this;
    }
}
