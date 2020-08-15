<?php

namespace forumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scrumnotes
 *
 * @ORM\Table(name="scrumnotes")
 * @ORM\Entity
 */
class Scrumnotes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="postedDate", type="string", length=50, nullable=false)
     */
    private $posteddate;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=30, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Scrumboard")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="scrumboardid", referencedColumnName="id")
     * })
     */
    private $scrumboardid;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=false)
     */
    private $state;



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
     * Set description
     *
     * @param string $description
     *
     * @return Scrumnotes
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set posteddate
     *
     * @param string $posteddate
     *
     * @return Scrumnotes
     */
    public function setPosteddate($posteddate)
    {
        $this->posteddate = $posteddate;

        return $this;
    }

    /**
     * Get posteddate
     *
     * @return string
     */
    public function getPosteddate()
    {
        return $this->posteddate;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     *
     * @return Scrumnotes
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Scrumnotes
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
     * Set scrumboardid
     *
     * @param integer $scrumboardid
     *
     * @return Scrumnotes
     */
    public function setScrumboardid($scrumboardid)
    {
        $this->scrumboardid = $scrumboardid;

        return $this;
    }

    /**
     * Get scrumboardid
     *
     * @return integer
     */
    public function getScrumboardid()
    {
        return $this->scrumboardid;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Scrumnotes
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
}
