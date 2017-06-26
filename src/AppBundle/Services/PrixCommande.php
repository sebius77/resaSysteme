<?php
// src/AppBundle/Services/prixCommande.php

namespace AppBundle\Services;

use AppBundle\Entity\Commande;

class PrixCommande {


    public function calculTotal(Commande $commande)
    {

        // On vérifie si la réservation est en demi journée ou non
        $demiJournee = $commande->getDemiJournee();

        // On récupère tous les billets réservés
        $billets = $commande->getBillets();

        $sousTotal = 0;

        foreach($billets as $billet)
        {
            $prixBillet = $billet->getCategorie()->getTarif();
            $sousTotal += $prixBillet;

        }

        // Si la réservation est une demi-journée
        // On divise la commande par 2
        if ($demiJournee === true) {
            $total = $sousTotal / 2;
        } else {
            $total = $sousTotal;
        }

        return $total;

    }
}