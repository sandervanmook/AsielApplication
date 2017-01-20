<?php

namespace Asiel\AnimalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\PictureRepository")
 * @Vich\Uploadable
 */
class Picture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var file
     *
     * @Vich\UploadableField(mapping="animal_picture", fileNameProperty="pictureName")
     */
    private $pictureFile;

    /**
     * @var string
     *
     * @ORM\Column(name="pictureName", type="string", length=255)
     */
    private $pictureName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\AnimalBundle\Entity\Animal", inversedBy="pictures")
     */
    private $animal;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $pictureFile
     *
     * @return Picture
     */
    public function setPictureFile(File $pictureFile = null)
    {
        $this->pictureFile = $pictureFile;

        if ($pictureFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get pictureFile
     *
     * @return string
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * Set pictureName
     *
     * @param string $pictureName
     *
     * @return Picture
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get pictureName
     *
     * @return string
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Picture
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set animal
     *
     * @param Animal $animal
     *
     * @return Picture
     */
    public function setAnimal(Animal $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @return string
     */
    public function getPublicURL()
    {
        return '/pictures/animals/'.$this->getPictureName();
    }
}
