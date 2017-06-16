<?php
// src/AppBundle/Services/BilletsRestants.php

namespace AppBundle\Services;


class BilletsRestants {


    /**
     * Vérifie si le nombre de billet réserver
     * ne fait pas dépasser la limite des 1000 billets autorisés
     * @param $billets
     * @param $stock
     * @return bool
     * @return int
     */
    public function depasseLimit($billets, $stock)
    {
        $resultat = $stock - $billets;
        if($resultat >= 0) {
            return $resultat;
        }
        return false;
    }
}