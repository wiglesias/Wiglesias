<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\SlugTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PortfolioCategory
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PortfolioCategoryRepository")
 * @ORM\Table(name="portfolio_category")
 */
class PortfolioCategory extends AbstractBase
{
    use TitleTrait;
    use SlugTrait;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Portafolio", mappedBy="categories")
     */
    private $portfolios;

    /**
     *
     * Methods
     *
     */

    /**
     * PortfolioCategory constructor.
     */
    public function __construct()
    {
        $this->portfolios = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getPortfolios()
    {
        return $this->portfolios;
    }

    /**
     * @param ArrayCollection $portfolios
     *
     * @return PortfolioCategory
     */
    public function setPortfolios($portfolios)
    {
        $this->portfolios = $portfolios;

        return $this;
    }

    /**
     * @param Portafolio $portafolio
     * @return $this
     */
    public function addPortfolio(Portafolio $portafolio)
    {
        $this->portfolios->add($portafolio);

        return $this;
    }

    /**
     * @param Portafolio $portafolio
     *
     * @return $this
     */
    public function removePortfolio(Portafolio $portafolio)
    {
        $this->portfolios->removeElement($portafolio);

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle() ? $this->getTitle() : '---';
    }
}
