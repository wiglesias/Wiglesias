<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Setting;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class SettingRepository.
 *
 * @category Repository
 *
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class SettingRepository extends EntityRepository
{
    /**
     * @param $slug
     *
     * @return QueryBuilder
     */
    public function getBySlugQB($slug)
    {
        return $this->createQueryBuilder('s')
            ->where('s.slug = :slug')
            ->setParameter('slug', $slug)
            ->setMaxResults(1)
        ;
    }

    /**
     * @param $slug
     *
     * @return Query
     */
    public function getBySlugQ($slug)
    {
        return $this->getBySlugQB($slug)->getQuery();
    }

    /**
     * @param $slug
     *
     * @return null|Setting
     */
    public function getBySlug($slug)
    {
        try {
            return $this->getBySlugQ($slug)->getOneOrNullResult();
        } catch (NonUniqueResultException $exception) {
            return null;
        }
    }
}
