<?php
// src/AppBundle/DataFixtures/ORM/LoadCategorie.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\JourVisite;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadJourVisite implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        $date1 = '2017-07-16';
        $date2 = '2017-07-18';
        $date3 = '2017-07-20';


        // Liste des noms de catégorie à ajouter
        $dates = array(
            $date1 => 0,
            $date2 => 1000,
            $date3 => 10,
        );


        foreach ($dates as $date => $nbre) {
            // On crée les dates
            $jourVisite = new JourVisite();
            $jourVisite->setDateVisite(new \DateTime($date));
            $jourVisite->setBilletsRestants($nbre);

            // On la persiste
            $manager->persist($jourVisite);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}