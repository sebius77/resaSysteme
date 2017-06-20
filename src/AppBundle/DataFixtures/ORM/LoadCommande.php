<?php
// src/AppBundle/DataFixtures/ORM/LoadCategorie.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Commande;

class LoadCommande implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $commandes = array(
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-10',120,100),
            array ('2017-07-12',120,10),

        );


        foreach ($commandes as $tab) {
            // On crée la commande
            $commande = new Commande();
            $commande->setDateReservation(new \DateTime($tab[0]));
            $commande->setPrixCommande($tab[1]);
            $commande->setNbreBillet($tab[2]);

            // On la persiste
            $manager->persist($commande);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}