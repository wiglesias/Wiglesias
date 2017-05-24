<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description trait
 *
 * @category Trait
 * @package  AppBundle\Entity\Traits
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
Trait DescriptionTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4000, nullable=true)
     */
    private $description;

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
     * Set description
     *
     * @param string $description
     *
     * @return DescriptionTrait
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
