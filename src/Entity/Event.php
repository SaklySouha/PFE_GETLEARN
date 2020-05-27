<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;




/**
 * @ApiResource(attributes={"normalization_context"={"groups"={"event"}, "enable_max_depth"=true}})
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @Vich\Uploadable()
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"event"})
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups({"event"})
     */

    private $eventfilename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="events_images",fileNameProperty="eventfilename")
     * @Groups({"event"})
     */

    private $imageEvent;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     */
    private $TitreE;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     */
    private $AdresseE;

    /**
     * @ORM\Column(type="date")
     * @Groups({"event"})
     */
    private $DateE;

    /**
     * @ORM\Column(type="time")
     * @Groups({"event"})
     */
    private $HeureE;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     */
    private $DescrE;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Event")
     * @Groups({"event"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="Event")
     * @Groups({"event"})
     */
    private $formateur;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     * @Groups({"event"})
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreE(): ?string
    {
        return $this->TitreE;
    }

    public function setTitreE(string $TitreE): self
    {
        $this->TitreE = $TitreE;

        return $this;
    }

    public function getAdresseE(): ?string
    {
        return $this->AdresseE;
    }

    public function setAdresseE(string $AdresseE): self
    {
        $this->AdresseE = $AdresseE;

        return $this;
    }

    public function getDateE(): ?\DateTimeInterface
    {
        return $this->DateE;
    }

    public function setDateE(\DateTimeInterface $DateE): self
    {
        $this->DateE = $DateE;

        return $this;
    }

    public function getHeureE(): ?\DateTimeInterface
    {
        return $this->HeureE;
    }

    public function setHeureE(\DateTimeInterface $HeureE): self
    {
        $this->HeureE = $HeureE;

        return $this;
    }

    public function getDescrE(): ?string
    {
        return $this->DescrE;
    }

    public function setDescrE(string $DescrE): self
    {
        $this->DescrE = $DescrE;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEventfilename(): ?string
    {
        return $this->eventfilename;
    }

    /**
     * @param string|null $eventfilename
     * @return Event
     */
    public function setEventfilename(?string $eventfilename): Event
    {
        $this->eventfilename = $eventfilename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageEvent(): ?File
    {
        return $this->imageEvent;
    }

    /**
     * @param File|null $imageEvent
     * @return Event
     */
    public function setImageEvent(?File $imageEvent): Event
    {
        $this->imageEvent = $imageEvent;
        if($this -> imageEvent instanceof UploadedFile ){
            $this ->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }




}
