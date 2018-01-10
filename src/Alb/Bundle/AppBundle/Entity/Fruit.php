<?php

namespace Alb\Bundle\AppBundle\Entity;

class Fruit
{
    protected $name;

    public function __construct($name = '')
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}