<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandeRepository extends EntityRepository
{


    /**
     * @param $dateResa
     * @return array
     * Méthode permettant de récupérer les commandes du jour réservé et de faire la somme
     * des billets commandé pour savoir si le stock est toujours disponible.
     */
    public function calculTotalBilletJour($dateResa)
    {
        return $this->createQueryBuilder('c')
            ->select('SUM(c.nbreBillet)')
            ->where('c.dateReservation = :dateResa')
            ->setParameter('dateResa', $dateResa)
            ->getQuery()
            ->getResult()
            ;
    }



}
