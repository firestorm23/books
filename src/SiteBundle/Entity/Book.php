<?php

namespace SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="SiteBundle\Repository\BookRepository")
 */
class Book
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
     * @ORM\Column(name="name", type="string", length=1024)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublished", type="datetime")
     */
    private $datePublished;

    /**
     *
     * @ORM\OneToOne(targetEntity="File", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     *
     */

    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=4096)
     */

    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="books")
     * @ORM\JoinTable(name="book_category")
     */

    private $categories;
    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer", nullable=true)
     */

    private $sort;

    function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function getCategoryNames()
    {
        $names = "";
        foreach ($this->categories as $cat)
            $names .= $cat."\n";
        return $names;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param mixed $category
     */
    public function addCategories($category)
    {
        $this->categories[] = $category;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

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
     *
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set datePublished
     *
     * @param \DateTime $datePublished
     *
     * @return Book
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}

