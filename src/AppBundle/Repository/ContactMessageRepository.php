<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ContactMessageRepository.
 *
 * @category Repository
 * @autor Wils Iglesias <wiglesias83@gmail.com>
 */
class ContactMessageRepository extends EntityRepository
{
    /**
     * @return QueryBuilder
     */
    public function getPendingMessagesAmountQB()
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.answered = :answered')
            ->setParameter('answered', false)
            ;
    }

    /**
     * @return Query
     */
    public function getPendingMessagesAmountQ()
    {
        return $this->getPendingMessagesAmountQB()->getQuery();
    }

    /**
     * @return int
     */
    public function getPendingMessagesAmount()
    {
        return $this->getPendingMessagesAmountQ()->getSingleScalarResult();
    }
}
