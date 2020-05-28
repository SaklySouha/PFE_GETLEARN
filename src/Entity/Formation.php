<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;




/**
 * @ApiResource(attributes={"normalization_context"={"groups"={"formation"}, "enable_max_depth"=true}})
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 * @UniqueEntity("nom")
 * @Vich\Uploadable()
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"formation"})
     */
    private $id;


    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups({"formation"})
     */

    private $formationfilename;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="formations_images",fileNameProperty="formationfilename")
     * @Groups({"formation"})
     */

    private $imageFormation;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     * @Groups({"formation"})
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"formation"})
     * @Groups({"cours"})
     */
    
    private $nom;

    /**
     * @Groups({"formation"})
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Groups({"formation"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Formation")
     */
    private $category;

    /**
     * @ORM\Column(type="float")
     * @Groups({"formation"})
     */
    private $prix;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cours", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"formation"})
     */
    private $cour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="Formation")
     * @Groups({"formation"})
     */
    private $formateur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"formation"})
     */
    private $descr;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="Formation")
     */
    private $users;


    /**
     * @return Cours
     */
    public function getCour()
    {
        return $this->cour;
    }

    /**
     * @param mixed $cour
     */
    public function setCour($cour)
    {
        $this->cour = $cour;
    }


    public function __construct()
    {
        $this->FormationUser = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationfilename(): ?string
    {
        return $this->formationfilename;
    }

    /**
     * @param string|null $formationfilename
     * @return Formation
     */
    public function setFormationfilename(?string $formationfilename): Formation
    {
        $this->formationfilename = $formationfilename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFormation(): ?File
    {
        return $this->imageFormation;
    }

    /**
     * @param File|null $imageFormation
     * @return Formation
     */
    public function setImageFormation(?File $imageFormation): Formation
    {
        $this->imageFormation = $imageFormation;
        if($this -> imageFormation instanceof UploadedFile ){
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
     * @return Formation
     */
    public function setUpdatedAt(\DateTime $updated_at): Formation
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFormation($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeFormation($this);
        }

        return $this;
    }




}
