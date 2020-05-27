<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;




/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 * @Vich\Uploadable()

 */
class Test
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

    private $testfilename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="fichiers_tests",fileNameProperty="testfilename")
     */

    private $fichierTest;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updated_at;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cours", cascade={"persist", "remove"},orphanRemoval=true)
     */
    private $Cours;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTestfilename(): ?string
    {
        return $this->testfilename;
    }

    /**
     * @param string|null $testfilename
     * @return Test
     */
    public function setTestfilename(?string $testfilename): Test
    {
        $this->testfilename = $testfilename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFichierTest(): ?File
    {
        return $this->fichierTest;
    }

    /**
     * @param File|null $fichierTest
     * @return Test
     */
    public function setFichierTest(?File $fichierTest): Test
    {
        $this->fichierTest = $fichierTest;
        if ($fichierTest) {
            $this->updated_at = new \DateTime('now');
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
     * @return Test
     */
    public function setUpdatedAt(\DateTime $updated_at): Test
    {
        $this->updated_at = $updated_at;
        return $this;
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
}
