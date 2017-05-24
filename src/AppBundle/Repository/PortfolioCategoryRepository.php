<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

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
    public function findEnabledSortedByTitleQB()
    {
        return $this->createQueryBuilder('pc')
            ->join('pc.portfolios', 'p')
            ->where('pc.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('pc.title', 'ASC');
    }

    /**
     * @return Query
     */
    public function findEnabledSortedByTitleQ()
    {
        return $this->findEnabledSortedByTitleQB()->getQuery();
    }

    /**
     * @return array
     */
    public function findEnabledSortedByTitle()
    {
        return $this->findEnabledSortedByTitleQ()->getResult();
    }
}
