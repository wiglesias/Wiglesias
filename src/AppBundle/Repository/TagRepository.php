<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Query\QueryBuilder;
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
     * @return ArrayCollection
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
     * @return ArrayCollection
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