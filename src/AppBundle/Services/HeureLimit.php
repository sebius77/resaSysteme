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
    public function estDepassee($jourResa)
    {

        // On définit l'heure actuelle
        $time = new \DateTime();

        // On format les dates au même format
        $jourActuel = $time->format('d-m-y');
        $jourResa = $jourResa->format('d-m-y');


        // On compare les dates
        // S'il s'agit de la date du jour on effectue cette condition
        if ($jourResa === $jourActuel) {

            $time = $time->format('H:i');

            //On définit la limite
            $limit = date('14:00');

            // On compare les 2 et on retourne un booléen
            if ($time > $limit) {
                return true;
            }

        }
        return false;

    }
}