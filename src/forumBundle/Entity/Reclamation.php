<?php

namespace forumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="postId", columns={"postId"})})
 * @ORM\Entity
 */
class Reclamation
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
     * @var Postsforum
     *
     * @ORM\ManyToOne(targetEntity="Postsforum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="postId", referencedColumnName="id")
     * })
     */
    private $postid;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * })
     */
    private $user;



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
     * @return Reclamation
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
     * @return Reclamation
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
     * Set postid
     *
     * @param \forumBundle\Entity\Postsforum $postid
     *
     * @return Reclamation
     */
    public function setPostid(\forumBundle\Entity\Postsforum $postid = null)
    {
        $this->postid = $postid;

        return $this;
    }

    /**
     * Get postid
     *
     * @return \forumBundle\Entity\Postsforum
     */
    public function getPostid()
    {
        return $this->postid;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $iduser
     *
     * @return Reclamation
     */
    public function setUser(\UserBundle\Entity\User $iduser = null)
    {
        $this->user = $iduser;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

}
