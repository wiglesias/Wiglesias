<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
Trait DateTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $date;

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDateString()
    {
        return $this->getDate()->format('d/m/Y');
    }
}
