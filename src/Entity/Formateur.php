<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\FormateurRepository")
 * @Vich\Uploadable()

 */
class Formateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     */

    private $formateurfilename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="formateurs_images",fileNameProperty="formateurfilename")
     */

    private $imageFormateur;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     *
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     * @Groups({"formation"})
     */
    private $nomF;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     * @Groups({"formation"})
     */
    private $prenomF;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreF;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienF;




    /**
     * @return mixed
     */
    public function getTitreF()
    {
        return $this->titreF;
    }

    /**
     * @param mixed $titreF
     * @return Formateur
     */
    public function setTitreF($titreF)
    {
        $this->titreF = $titreF;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefF()
    {
        return $this->defF;
    }

    /**
     * @param mixed $defF
     * @return Formateur
     */
    public function setDefF($defF)
    {
        $this->defF = $defF;
        return $this;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $defF;
  

   

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formation", mappedBy="formateur",cascade={"persist", "remove"},orphanRemoval=true)
     */
    private $Formation;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="formateur",cascade={"persist", "remove"},orphanRemoval=true)
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

    public function getNomF(): ?string
    {
        return $this->nomF;
    }

    public function setNomF(string $nomF): self
    {
        $this->nomF = $nomF;

        return $this;
    }

    public function getPrenomF(): ?string
    {
        return $this->prenomF;
    }

    public function setPrenomF(string $prenomF): self
    {
        $this->prenomF = $prenomF;

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
            $formation->setFormateur($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->Formation->contains($formation)) {
            $this->Formation->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getFormateur() === $this) {
                $formation->setFormateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->Event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->Event->contains($event)) {
            $this->Event[] = $event;
            $event->setFormateur($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->Event->contains($event)) {
            $this->Event->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getFormateur() === $this) {
                $event->setFormateur(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormateurfilename(): ?string
    {
        return $this->formateurfilename;
    }

    /**
     * @param string|null $formateurfilename
     * @return Formateur
     */
    public function setFormateurfilename(?string $formateurfilename): Formateur
    {
        $this->formateurfilename = $formateurfilename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFormateur(): ?File
    {
        return $this->imageFormateur;
    }

    /**
     * @param File|null $imageFormateur
     * @return Formateur
     */
    public function setImageFormateur(?File $imageFormateur): Formateur
    {
        $this->imageFormateur = $imageFormateur;
        if($this -> imageFormateur instanceof UploadedFile ){
            $this ->updated_at = new \DateTime('now');
        }
        return $this;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     * @return Formateur
     */
    public function setUpdatedAt(\DateTime $updated_at): Formateur
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLienF()
    {
        return $this->lienF;
    }

    /**
     * @param mixed $lienF
     * @return Formateur
     */
    public function setLienF($lienF)
    {
        $this->lienF = $lienF;
        return $this;
    }


}
