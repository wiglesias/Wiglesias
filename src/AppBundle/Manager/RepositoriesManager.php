<?php

namespace AppBundle\Manager;

use AppBundle\Repository\BankRepository;
use AppBundle\Repository\CityRepository;
use AppBundle\Repository\PortfolioCategoryRepository;

/**
 * Class RepositoriesManager.
 *
 * @category Manager
 *
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
     * @var BankRepository
     */
    private $bankRepository;

    /**
     * Methods.
     */

    /**
     * RepositoriesManager constructor.
     *
     * @param PortfolioCategoryRepository $portfolioCategoryRepository
     * @param CityRepository              $cityRepository
     * @param BankRepository              $bankRepository
     */
    public function __construct(PortfolioCategoryRepository $portfolioCategoryRepository, CityRepository $cityRepository, BankRepository $bankRepository)
    {
        $this->portfolioCategoryRepository = $portfolioCategoryRepository;
        $this->cityRepository = $cityRepository;
        $this->bankRepository = $bankRepository;
    }

    /**
     * @return PortfolioCategoryRepository
     */
    public function getPortfolioCategoryRepository()
    {
        return $this->portfolioCategoryRepository;
    }

    /**
     * @return CityRepository
     */
    public function getCityRepository()
    {
        return $this->cityRepository;
    }

    /**
     * @return BankRepository
     */
    public function bankRepository()
    {
        return $this->bankRepository;
    }
}
