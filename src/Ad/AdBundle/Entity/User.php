<?php

namespace Ad\AdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Ad;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Ad\AdBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="username", type="string", length=33, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=20)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Ad\AdBundle\Entity\Ad", mappedBy="user")
     */
    private $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }
    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param mixed $ads
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add ad
     *
     * @param \Ad\AdBundle\Entity\Ad $ad
     *
     * @return User
     */
    public function addAd(\Ad\AdBundle\Entity\Ad $ad)
    {
        $this->ads[] = $ad;

        return $this;
    }

    /**
     * Remove ad
     *
     * @param \Ad\AdBundle\Entity\Ad $ad
     */
    public function removeAd(\Ad\AdBundle\Entity\Ad $ad)
    {
        $this->ads->removeElement($ad);
    }
}
