<?php

namespace Alb\Bundle\AppBundle\Entity;

class Tag
{
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Alb\Bundle\AppBundle\Entity\Task
     */
    private $task;


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
     * Set task
     *
     * @param \Alb\Bundle\AppBundle\Entity\Task $task
     *
     * @return Tag
     */
    public function setTask(\Alb\Bundle\AppBundle\Entity\Task $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Alb\Bundle\AppBundle\Entity\Task
     */
    public function getTask()
    {
        return $this->task;
    }
}
