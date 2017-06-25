<?php
// src/AppBundle/Services/VerifCategorie.php

namespace AppBundle\Services;



class VerifCategorie {


    /**
     * @param $date
     * Méthode permettant de déterminer la catégorie
     * du billet en fonction de la date de naissance
     * @return int;
     */
    public function determineCat($date)
    {
        $now = new \DateTime();
        $now = $now->format('d-m-Y');
        $now = new \DateTime($now);

        $age = $now->diff($date)->format('%y');

        //return $age;


        switch ($age) {
            case $age < 4:
                $cat = "gratuit";
                break;
            case  $age < 12 && $age > 4:
                $cat = "enfant";
                break;
            case $age > 12 && $age < 60:
                $cat = "normal";
                break;
            case $age > 60:
                $cat = "senior";
                break;
            default:
                $cat = "erreur";
                break;
        }

        return $cat;

    }
}