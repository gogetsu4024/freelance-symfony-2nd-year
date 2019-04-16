<?php

namespace forumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Postsforum
 *
 * @ORM\Table(name="postsforum", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="categoryId", columns={"categoryId"})})
 * @ORM\Entity
 */
class Postsforum
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
     * @ORM\Column(name="subject", type="string", length=50, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postedDate", type="datetime", nullable=false)
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
    private $iduser;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     * })
     */
    private $categoryid;


    /**
     * @ORM\OneToMany(targetEntity="forumBundle\Entity\Postscomments", mappedBy="idpost")
     */
    private $comments;

    /**
     * @var int
     *
     * @ORM\Column(name="views", type="integer",options={"default" : 0})
     */
    private $views;
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }
    public function getViews()
    {
        return $this->views;
    }
    public function getComments(){
        return $this->comments;
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
     * Set subject
     *
     * @param string $subject
     *
     * @return Postsforum
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Postsforum
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
     * @param \DateTime $posteddate
     *
     * @return Postsforum
     */
    public function setPosteddate($posteddate)
    {
        $this->posteddate = $posteddate;

        return $this;
    }

    /**
     * Get posteddate
     *
     * @return \DateTime
     */
    public function getPosteddate()
    {
        return $this->posteddate;
    }

    /**
     * Set iduser
     *
     * @param \UserBundle\Entity\User $iduser
     *
     * @return Postsforum
     */
    public function setIduser(\UserBundle\Entity\User $iduser = null)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return \UserBundle\Entity\User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set categoryid
     *
     * @param \forumBundle\Entity\Category $categoryid
     *
     * @return Postsforum
     */
    public function setCategoryid(\forumBundle\Entity\Category $categoryid = null)
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    /**
     * Get categoryid
     *
     * @return \forumBundle\Entity\Category
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }
}
