<?php

namespace SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File as HttpFoundationFile;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="SiteBundle\Repository\FileRepository")
 *
 * @Vich\Uploadable
 */
class File
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var array
     * @Assert\File( maxSize="100M")
     * @Vich\UploadableField(mapping="upload", fileNameProperty="originalName")
     *
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="originalName", type="string", length=255)
     */
    private $originalName;

    /**
     * @var string
     *
     * @ORM\Column(name="dirname", type="string", length=255)
     */
    private $dirname;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="mimetype", type="string", length=255)
     */
    private $mimetype;


    function __construct()
    {

    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get file
     *
     * @return array
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param array $file
     * @return File
     */
    public function setFile($file)
    {
        if (is_null($file)) {
            return $this;
        } else if (is_a($file, 'Symfony\Component\HttpFoundation\File\File')) {
            //специальная строчка. принудительно устанавливаем поле name, чтобы подхватилось событие preUpdate, так как само
            //поле file не размечено для Doctrine и не управляется ею
            $this->name = $file->getFilename();
            $this->file = $file;
        }



        return $this;
    }

    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set originalName
     *
     * @param string $originalName
     * @return File
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return File
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get mimetype
     *
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Set mimetype
     *
     * @param string $mimetype
     * @return File
     */
    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;

        return $this;
    }

    public function __toString() {
        return $this->getDirname()."/".$this->getName();
    }

    /**
     * Get dirname
     *
     * @return string
     */
    public function getDirname()
    {
        return $this->dirname;
    }

    /**
     * Set dirname
     *
     * @param string $dirname
     * @return File
     */
    public function setDirname($dirname)
    {
        $this->dirname = $dirname;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
