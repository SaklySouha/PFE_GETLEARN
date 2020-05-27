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
 * @ApiResource(attributes={"normalization_context"={"groups"={"section"}, "enable_max_depth"=true}})
 * @ORM\Entity(repositoryClass="App\Repository\SectionRepository")
 * @Vich\Uploadable()

 */
class Section
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"section"})
     */
    private $id;


    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups({"section"})
     */

    private $sectionfilename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="sections_videos",fileNameProperty="sectionfilename")
     * @Groups({"section"})
     */

    private $videoSection;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups({"section"})
     */

    private $sectionfilename2;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="sections_fichiers",fileNameProperty="sectionfilename2")
     * @Groups({"section"})
     */

    private $fichierSection;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups({"section"})
     */

    private $sectionfilename3;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="sections_imagesv",fileNameProperty="sectionfilename3")
     * @Groups({"section"})
     */

    private $imagevSection;





    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"section"})
     */

    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"section"})
     */
    private $descr;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapitre", inversedBy="sections")
     * @Groups({"section"})
     */
    private $Chapitre;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     * @Groups({"section"})
     *
     */
    private $updated_at;

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

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }




    public function getChapitre(): ?Chapitre
    {
        return $this->Chapitre;
    }

    public function setChapitre(?Chapitre $Chapitre): self
    {
        $this->Chapitre = $Chapitre;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSectionfilename(): ?string
    {
        return $this->sectionfilename;
    }

    /**
     * @param string|null $sectionfilename
     * @return Section
     */
    public function setSectionfilename(?string $sectionfilename): Section
    {
        $this->sectionfilename = $sectionfilename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getVideoSection(): ?File
    {
        return $this->videoSection;
    }

    /**
     * @param File|null $videoSection
     * @return Section
     */
    public function setVideoSection(?File $videoSection): Section
    {
        $this->videoSection = $videoSection;

        if($this -> videoSection instanceof UploadedFile ){
            $this ->updated_at = new \DateTime('now');
        }
        return $this;
    }

  
    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updated_at;
    }

   
    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSectionfilename2(): ?string
    {
        return $this->sectionfilename2;
    }

    /**
     * @param string|null $sectionfilename2
     * @return Section
     */
    public function setSectionfilename2(?string $sectionfilename2): Section
    {
        $this->sectionfilename2 = $sectionfilename2;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFichierSection(): ?File
    {
        return $this->fichierSection;
    }

    /**
     * @param File|null $fichierSection
     * @return Section
     */
    public function setFichierSection(?File $fichierSection): Section
    {
        $this->fichierSection = $fichierSection;
        if($this -> fichierSection instanceof UploadedFile ){
            $this ->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSectionfilename3(): ?string
    {
        return $this->sectionfilename3;
    }

    /**
     * @param string|null $sectionfilename3
     * @return Section
     */
    public function setSectionfilename3(?string $sectionfilename3): Section
    {
        $this->sectionfilename3 = $sectionfilename3;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImagevSection(): ?File
    {
        return $this->imagevSection;
    }

    /**
     * @param File|null $imagevSection
     * @return Section
     */
    public function setImagevSection(?File $imagevSection): Section
    {
        $this->imagevSection = $imagevSection;
        if($this -> imagevSection instanceof UploadedFile ){
            $this ->updated_at = new \DateTime('now');
        }
        return $this;
    }



}
