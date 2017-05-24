<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Title Trait
 *
 * @category trait
 * @package  AppBundle\Entity\Traits
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
Trait TitleTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

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
     * Set title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
