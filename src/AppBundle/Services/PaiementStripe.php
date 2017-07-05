<?php
// src/AppBundle/Services/paiementStripe.php

namespace AppBundle\Services;

use AppBundle\Entity\Commande;

class PaiementStripe {


    public function paiementCommande(Commande $commande)
    {

        $prixCommande = $commande->getPrixCommande();
        $prixCommande = $prixCommande * 100;

        \Stripe\Stripe::setApiKey("sk_test_8WldlRZciBFA3rUiPpWGdzG5");

        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        $mail = $_POST['stripeEmail'];

        $commande->setMail($mail);

        // Create a charge: this will charge the user's card
        try {

            $charge = \Stripe\Charge::create(array(
                "amount" => $prixCommande, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Billetterie Louvre",
            ));


            return true;
        } catch(\Stripe\Error\Card $e) {

            return $e;
        }

    }
}