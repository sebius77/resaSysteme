<?php
// src/AppBundle/DataFixtures/ORM/LoadCategorie.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Categorie;

class LoadCategorie implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'normal' => 16,
            'senior' => 12,
            'enfant' => 8,
            'reduit' => 10,
        );


        foreach ($names as $name => $tarif) {
            // On crée la catégorie
            $category = new Categorie();
            $category->setNom($name);
            $category->setTarif($tarif);

            // On la persiste
            $manager->persist($category);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}