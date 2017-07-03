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
        if(is_array($stock))
        {
            $stockBillet = (int) $stock[0][1];
        } else {
            $stockBillet = $stock;
        }

        $billetJour =(int) $billetJour;

        $stockRestant = 1000 - $stockBillet;


        $resultat = $stockRestant - $billetJour;
        if($resultat < 0) {
            return true;
        }

        return false;

    }
}