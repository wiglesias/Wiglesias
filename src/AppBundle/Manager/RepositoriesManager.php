<?php

namespace AppBundle\Manager;

use AppBundle\Repository\CityRepository;
use AppBundle\Repository\PortfolioCategoryRepository;

/**
 * Class RepositoriesManager
 *
 * @category Manager
 * @package  AppBundle\Manager
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class RepositoriesManager
{
    /**
     * @var PortfolioCategoryRepository
     */
    private $portfolioCategoryRepository;

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * Methods.
     */

    /**
     * RepositoriesManager constructor.
     *
     * @param PortfolioCategoryRepository $portfolioCategoryRepository
     * @param CityRepository $cityRepository
     */
    public function __construct(PortfolioCategoryRepository $portfolioCategoryRepository, CityRepository $cityRepository)
    {
        $this->portfolioCategoryRepository = $portfolioCategoryRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return PortfolioCategoryRepository
     */
    public function getPortfolioCategoryRepository()
    {
        return $this->portfolioCategoryRepository;
    }

    public function getCityRepository()
    {
        return $this->cityRepository;
    }
}
