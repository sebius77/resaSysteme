<?php
// src/AppBundle/Services/HeureLimit.php

namespace AppBundle\Services;



class HeureLimit {


    /**
     * Vérifie si le nombre de billet réserver
     * ne fait pas dépasser la limite des 1000 billets autorisés
     * @param $billet
     * @param $stock
     * @return bool
     */
    public function estDepassee()
    {

        // On définit l'heure actuelle
        $time = new \DateTime();
        $time = $time->format('H:i');

        //On définit la limite
        $limit = date('14:00');

        // On compare les 2 et on retourne un booléen
        if($time > $limit)
        {
            return true;
        }

        return false;

    }
}