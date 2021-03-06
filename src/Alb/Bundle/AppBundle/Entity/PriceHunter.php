<?php

namespace Alb\Bundle\AppBundle\Entity;

/**
 * PriceHunter
 */
class PriceHunter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var float
     */
    public $price;

    /**
     * @var float
     */
    public $price_min;

    /**
     * @var float
     */
    public $price_max;

    /**
     * @var string
     */
    public $link;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var string
     */
    public $image = 'noimage.jpg';

    /**
     * @var string
     */
    public $content;

    /**
     * @var \DateTime
     */
    public $created_at;

    /**
     * @var \DateTime
     */
    public $updated_at;


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
     * Set title
     *
     * @param string $title
     *
     * @return PriceHunter
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
     * Set price
     *
     * @param float $price
     *
     * @return PriceHunter
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceMin
     *
     * @param float $priceMin
     *
     * @return PriceHunter
     */
    public function setPriceMin($priceMin)
    {
        $this->price_min = $priceMin;

        return $this;
    }

    /**
     * Get priceMin
     *
     * @return float
     */
    public function getPriceMin()
    {
        return $this->price_min;
    }

    /**
     * Set priceMax
     *
     * @param float $priceMax
     *
     * @return PriceHunter
     */
    public function setPriceMax($priceMax)
    {
        $this->price_max = $priceMax;

        return $this;
    }

    /**
     * Get priceMax
     *
     * @return float
     */
    public function getPriceMax()
    {
        return $this->price_max;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return PriceHunter
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return PriceHunter
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
     * Set image
     *
     * @param string $image
     *
     * @return PriceHunter
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return PriceHunter
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PriceHunter
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PriceHunter
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}

