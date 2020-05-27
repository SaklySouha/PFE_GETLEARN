<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(attributes={"normalization_context"={"groups"={"cours"}, "enable_max_depth"=true}})
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 * @Vich\Uploadable()
 */
class Cours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"cours"})
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups({"cours"})
     */

    private $courfilename;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="cours_images",fileNameProperty="courfilename")
     * @Groups({"cours"})
     */

    private $imageCour;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     * @Groups({"cours"})
     *
     */
    private $updated_at;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cours"})
     * @Groups({"formation"})
     * @Groups({"chapitre"})
     */
    private $titre;






    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Formation")
     * @Groups({"cours"})
     */
    private $formation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chapitre", mappedBy="Cours", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"cours"})
     */
    private $chapitres;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Test", cascade={"persist", "remove"},orphanRemoval=true)
     */
    private $test;

    /**
     * @return mixed
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param mixed $test
     */
    public function setTest($test): void
    {
        $this->test = $test;
    }

    
    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
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


  
    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection|Chapitre[]
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres[] = $chapitre;
            $chapitre->setCours($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): self
    {
        if ($this->chapitres->contains($chapitre)) {
            $this->chapitres->removeElement($chapitre);
            // set the owning side to null (unless already changed)
            if ($chapitre->getCours() === $this) {
                $chapitre->setCours(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCourfilename(): ?string
    {
        return $this->courfilename;
    }

    /**
     * @param string|null $courfilename
     * @return Cours
     */
    public function setCourfilename(?string $courfilename): Cours
    {
        $this->courfilename = $courfilename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageCour(): ?File
    {
        return $this->imageCour;
    }

    /**
     * @param File|null $imageCour
     * @return Cours
     */
    public function setImageCour(?File $imageCour): Cours
    {
        $this->imageCour = $imageCour;
        if($this -> imageCour instanceof UploadedFile ){
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
     * @return Cours
     */
    public function setUpdatedAt(\DateTime $updated_at): Cours
    {
        $this->updated_at = $updated_at;
        return $this;
    }


}
