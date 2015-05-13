<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BookRepository")
 * @ExclusionPolicy("all")
 */
class Book {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="books", cascade={"persist"})
     * @Expose
     */
    private $authors;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releasedate", type="datetime")
     * @Expose
     */
    private $releasedate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Expose
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="books", cascade={"persist"})
     * @Expose
     */
    private $genres;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="books", cascade={"persist"})
     * @Expose
     */
    private $editor;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set releasedate
     *
     * @param \DateTime $releasedate
     * @return Book
     */
    public function setReleasedate($releasedate) {
        $this->releasedate = $releasedate;

        return $this;
    }

    /**
     * Get releasedate
     *
     * @return \DateTime 
     */
    public function getReleasedate() {
        return $this->releasedate;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Book
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set categories
     *
     * @param string $categories
     * @return Book
     */
    public function setCategories($categories) {
        $this->categories = $categories;
        return $this;
    }

    /**
     * Get categories
     *
     * @return string 
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add authors
     *
     * @param \AppBundle\Entity\Author $authors
     * @return Book
     */
    public function addAuthor(\AppBundle\Entity\Author $authors)
    {
        $this->authors[] = $authors;
        $author->addBook($this);
    
        return $this;
    }

    /**
     * Remove authors
     *
     * @param \AppBundle\Entity\Author $authors
     */
    public function removeAuthor(\AppBundle\Entity\Author $authors)
    {
        $this->authors->removeElement($authors);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Add genres
     *
     * @param \AppBundle\Entity\Genre $genres
     * @return Book
     */
    public function addGenre(\AppBundle\Entity\Genre $genres)
    {
        $this->genres[] = $genres;
    
        return $this;
    }

    /**
     * Remove genres
     *
     * @param \AppBundle\Entity\Genre $genres
     */
    public function removeGenre(\AppBundle\Entity\Genre $genres)
    {
        $this->genres->removeElement($genres);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set editor
     *
     * @param \AppBundle\Entity\Editor $editor
     * @return Book
     */
    public function setEditor(\AppBundle\Entity\Editor $editor = null)
    {
        $this->editor = $editor;
    
        return $this;
    }

    /**
     * Get editor
     *
     * @return \AppBundle\Entity\Editor 
     */
    public function getEditor()
    {
        return $this->editor;
    }
}
