<?php
// src/AppBundle/Services/verifStock.php

namespace AppBundle\Services;


class VerifStock {


    /**
     * Vérifie si le nombre de billet réserver
     * ne fait pas dépasser la limite des 1000 billets autorisés
     * @param $billet
     * @param $stock
     * @return bool
     */
    public function insuffisant($stock, $billetJour)
    {

        $resultat = $stock + $billetJour;
        if($resultat > 1000) {
            return true;
        }

        return false;

    }
}