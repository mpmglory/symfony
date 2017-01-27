<?php

namespace PMM\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * entity
 *
 * @ORM\Table(name="pmm_user")
 * @ORM\Entity(repositoryClass="PMM\UserBundle\Repository\entityRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}