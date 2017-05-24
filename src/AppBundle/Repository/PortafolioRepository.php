<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PortfolioCategory;
use Doctrine\ORM\EntityRepository;

/**
 * Class PortafolioRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class PortafolioRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAllEnabledSortedByDate()
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.date', 'DESC');

        return $query->getQuery()->getResult();
    }

    /**
     * @param PortfolioCategory $category
     *
     * @return array
     */
    public function getPortfoliosByCategoryEnabledSortedByDateWithJoin(PortfolioCategory $category)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p, c')
            ->join('p.categories', 'c')
            ->where('p.enabled = :enabled')
            ->andWhere('c.id = :cid')
            ->setParameter('enabled', true)
            ->setParameter('cid', $category->getId())
            ->orderBy('p.date', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
