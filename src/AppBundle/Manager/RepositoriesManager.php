<?php

namespace AppBundle\Manager;

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
     * Methods.
     */

    /**
     * RepositoriesManager constructor.
     *
     * @param PortfolioCategoryRepository $portfolioCategoryRepository
     */
    public function __construct(PortfolioCategoryRepository $portfolioCategoryRepository)
    {
        $this->portfolioCategoryRepository = $portfolioCategoryRepository;
    }

    /**
     * @return PortfolioCategoryRepository
     */
    public function getPortfolioCategoryRepository()
    {
        return $this->portfolioCategoryRepository;
    }
}
