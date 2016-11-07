<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class PortafolioRepository
 *
 * @category Repository
 * @package AppBundle\Repository
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class PortafolioRepository extends EntityRepository
{
    /**
     * @return ArrayCollection
     */
    public function getAllEnabledSortedByPublishedDate()
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}