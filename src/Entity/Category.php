<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     * @Groups({"formation"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descri;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formation", mappedBy="category",cascade={"persist", "remove"},orphanRemoval=true)
     */
    private $Formation;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="category",cascade={"persist", "remove"})
     */
    private $Event;

    public function __construct()
    {
        $this->Formation = new ArrayCollection();
        $this->Event = new ArrayCollection();
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

    public function getDescri(): ?string
    {
        return $this->descri;
    }

    public function setDescri(string $descri): self
    {
        $this->descri = $descri;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->Formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->Formation->contains($formation)) {
            $this->Formation[] = $formation;
            $formation->setCategory($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->Formation->contains($formation)) {
            $this->Formation->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getCategory() === $this) {
                $formation->setCategory(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|event[]
     */
    public function getEvent(): Collection
    {
        return $this->Event;
    }

    public function addEvent(event $event): self
    {
        if (!$this->Event->contains($event)) {
            $this->Event[] = $event;
            $event->setCategory($this);
        }

        return $this;
    }

    public function removeEvent(event $event): self
    {
        if ($this->Event->contains($event)) {
            $this->Event->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getCategory() === $this) {
                $event->setCategory(null);
            }
        }

        return $this;
    }
}
