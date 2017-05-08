<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 *
 * @category Repository
 * @package AppBundle\Repository
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class PostRepository extends EntityRepository
{
    /**
     * @return array
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

    /**
     * @param $limit
     *
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateLimit($limit)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->setMaxResults($limit)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoin()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p, t')
            ->join('p.tags', 't')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoinUntilNow()
    {
        $now = new \DateTime();
        $query = $this->createQueryBuilder('p')
            ->select('p, t')
            ->join('p.tags', 't')
            ->where('p.enabled = :enabled')
            ->andWhere('p.publishedAt <= :published')
            ->setParameter('enabled', true)
            ->setParameter('published', $now->format('Y-m-d'))
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param Tag $tag
     *
     * @return array
     */
    public function getPostsByTagEnabledSortedByPublishedDate(Tag $tag)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.tags', 't')
            ->where('p.enabled = :enabled')
            ->andWhere('t.id = :tid')
            ->setParameter('enabled', true)
            ->setParameter('tid', $tag->getId())
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param Tag $tag
     *
     * @return array
     */
    public function getPostsByTagEnabledSortedByPublishedDateWithJoin(Tag $tag)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p, t')
            ->join('p.categories', 't')
            ->where('p.enabled = :enabled')
            ->andWhere('t.id = :tid')
            ->setParameter('enabled', true)
            ->setParameter('tid', $tag->getId())
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param Tag $tag
     *
     * @return array
     */
    public function getPostsByTagEnabledSortedByPublishedDateWithJoinUntilNow(Tag $tag)
    {
        $now = new \DateTime();
        $query = $this->createQueryBuilder('p')
            ->select('p, t')
            ->join('p.tags', 't')
            ->where('p.enabled = :enabled')
            ->andWhere('t.id = :tid')
            ->andWhere('p.publishedAt <= :published')
            ->setParameter('enabled', true)
            ->setParameter('published', $now->format('Y-m-d'))
            ->setParameter('tid', $tag->getId())
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
