<?php

namespace AppBundle\Repository;

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
    public function findAllEnabledSortedByDate()
    {
        $query = $this->createQueryBuilder('e')
            ->where('e.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('e.date', 'DESC');

        return $query->getQuery()->getResult();
    }
}