<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\SlugTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 *
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

    public function __construct()
    {
        $this->portfolios = new ArrayCollection();
    }

    /**
     * @return Collection|Portafolio[]
     */
    public function getPortfolios(): Collection
    {
        return $this->portfolios;
    }

    public function addPortfolio(Portafolio $portafolio): self
    {
        if ($this->portfolios->contains($portafolio)) {
            $this->updatedAt[] = $portafolio;
            $portafolio->addCategory($this);
        }

        return $this;
    }

    public function removePortfolio(Portafolio $portafolio): self
    {
        if ($this->portfolios->contains($portafolio)) {
            $this->portfolios->removeElement($portafolio);
            $portafolio->removeCategory($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle() ? $this->getTitle() : '---';
    }
}
