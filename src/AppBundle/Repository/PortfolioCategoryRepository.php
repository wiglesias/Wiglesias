<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class PortfolioCategoryRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class PortfolioCategoryRepository extends EntityRepository
{
    /**
     * @return QueryBuilder
     */
    public function getAllSortedByTitleQB()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.title', 'ASC');
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByTitle()
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('c.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByTitleWithJoin()
    {
        $query = $this->createQueryBuilder('c')
            ->select('c, p')
            ->join('c.portfolios', 'p')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('c.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
