<?php

namespace PMM\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="PMM\PlatformBundle\Repository\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
	
	 /**
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;
	
	/**
     * @ORM\Column(name="nbreApplications", type="integer")
     */
    private $nbreApplications = 0;
	
	/**
     * @ORM\ManyToMany(targetEntity="PMM\PlatformBundle\Entity\Category", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="advert_category")
	 */
    private $categories;
	
	/**
     * @ORM\OneToOne(targetEntity="PMM\PlatformBundle\Entity\Image", cascade={"persist"})
     */
    private $image;
	
	 /**
     * @Gedmo\Slug(fields={"title"})
	 * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
	private $slug;
	
	/**
     * @ORM\OneToMany(targetEntity="PMM\PlatformBundle\Entity\Application", mappedBy="advert")
     */
    private $applications;
	
	 /**
     * Constructeur de la classe
     */
    public function __construct()
    {
        $this->date = new \Datetime();
		$this->categories = new ArrayCollection();
		$this->applications = new ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
	

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Advert
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set image
     *
     * @param \PMM\Platform\Entity\Image $image
     *
     * @return Advert
     */
    public function setImage(Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \PMM\Platform\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add category
     *
     * @param \PMM\PlatformBundle\Entity\Category $category
     *
     * @return Advert
     */
    public function addCategory(\PMM\PlatformBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \PMM\PlatformBundle\Entity\Category $category
     */
    public function removeCategory(\PMM\PlatformBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Advert
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
	
	/**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdateAt(new \Datetime());
    }
	
	public function increaseNbreApplication()
    {
        $this->nbreApplications++;
    }
	
	public function decreaseNbreApplication()
    {
        $this->nbreApplications--;
    }
	

    /**
     * Set nbreApplications
     *
     * @param integer $nbreApplications
     *
     * @return Advert
     */
    public function setNbreApplications($nbreApplications)
    {
        $this->nbreApplications = $nbreApplications;

        return $this;
    }

    /**
     * Get nbreApplications
     *
     * @return integer
     */
    public function getNbreApplications()
    {
        return $this->nbreApplications;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Advert
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add application
     *
     * @param \PMM\PlatformBundle\Entity\Application $application
     *
     * @return Advert
     */
    public function addApplication(\PMM\PlatformBundle\Entity\Application $application)
    {
        $this->applications[] = $application;

        return $this;
    }

    /**
     * Remove application
     *
     * @param \PMM\PlatformBundle\Entity\Application $application
     */
    public function removeApplication(\PMM\PlatformBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }
}
