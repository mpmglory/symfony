<?php

namespace PMM\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PMM\PlatformBundle\Entity\Advert;
use PMM\PlatformBundle\Entity\Skill;

/**
 * Skill
 *
 * @ORM\Table(name="pmm_advert_skill")
 * @ORM\Entity(repositoryClass="PMM\PlatformBundle\Repository\AdvertSkillRepository") 
 */
class AdvertSkill
{

	/**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;	
	
	/**
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

	/**
     * @ORM\ManyToOne(targetEntity="PMM\PlatformBundle\Entity\Advert")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $advert;

	/**
     * @ORM\ManyToOne(targetEntity="PMM\PlatformBundle\Entity\Skill")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

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
     * Set level
     *
     * @param string $level
     *
     * @return AdvertSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set advert
     *
     * @param \PMM\PlatformBundle\Entity\Advert $advert
     *
     * @return AdvertSkill
     */
    public function setAdvert(\PMM\PlatformBundle\Entity\Advert $advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \PMM\PlatformBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set skill
     *
     * @param \PMM\PlatformBundle\Entity\Skill $skill
     *
     * @return AdvertSkill
     */
    public function setSkill(\PMM\PlatformBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \PMM\PlatformBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
