<?php

namespace AppBundle\Repository;

use \Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;

/**
 * Class TagRepository
 *
 * @category Repository
 * @package AppBundle\Repository
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class TagRepository extends EntityRepository
{
    /**
     * @return QueryBuilder
     */
    public function getAllSortedByTitleQB()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.title', 'ASC');
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByTitle()
    {
        $query = $this->createQueryBuilder('t')
            ->where('t.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('t.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByTitleWithJoin()
    {
        $query = $this->createQueryBuilder('t')
            ->select('t, p')
            ->join('t.posts', 'p')
            ->where('t.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('t.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}