<?php

namespace Alb\Bundle\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Alb\Bundle\BackendBundle\Repository\CategoryRepository")
 */
class Category
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
     */
    private $name;

    /**
     * @var parent
     */
    private $parent;


    /**
     * @var arrayCollection
     */
    private $children;

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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

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
    * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="category")
    */
    private $blogPosts;

    public function __construct()
    {
        $this->blogPosts = new ArrayCollection();
        $this->children = new ArrayCllection();
    }

    public function getBlogPosts()
    {
        return $this->blogPosts;
    }

    public function getChildren() {
        return $this->children;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Category
     */
    public function setParent(Category $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }
}

