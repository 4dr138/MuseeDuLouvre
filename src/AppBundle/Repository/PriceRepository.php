<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PriceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 *
 */
class PriceRepository extends EntityRepository
{
    public function getPrice($tarif)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->select('p.price')
            ->where('p.tarif = :tarif')
            ->setParameter('tarif', $tarif);

        return $qb->getQuery()->execute();
    }
}