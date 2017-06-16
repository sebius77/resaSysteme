<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande_JourVisite
 *
 * @ORM\Table(name="commande_jour_visite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Commande_JourVisiteRepository")
 */
class Commande_JourVisite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Commande", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;


    /**
     * @ORM\ManyToOne(targetEntity="JourVisite")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jourVisite;


    /**
     * @var int
     * @ORM\Column(name="nbre_total_billet_jour", type="integer")
     */
    private $nbreTotalBilletJour;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nbreTotalBilletJour
     *
     * @param integer $nbreTotalBilletJour
     *
     * @return Commande_JourVisite
     */
    public function setNbreTotalBilletJour($nbreTotalBilletJour)
    {
        $this->nbreTotalBilletJour = $nbreTotalBilletJour;

        return $this;
    }

    /**
     * Get nbreTotalBilletJour
     *
     * @return integer
     */
    public function getNbreTotalBilletJour()
    {
        return $this->nbreTotalBilletJour;
    }

    /**
     * Set commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return Commande_JourVisite
     */
    public function setCommande(\AppBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \AppBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set jourVisite
     *
     * @param \AppBundle\Entity\JourVisite $jourVisite
     *
     * @return Commande_JourVisite
     */
    public function setJourVisite(\AppBundle\Entity\JourVisite $jourVisite)
    {
        $this->jourVisite = $jourVisite;

        return $this;
    }

    /**
     * Get jourVisite
     *
     * @return \AppBundle\Entity\JourVisite
     */
    public function getJourVisite()
    {
        return $this->jourVisite;
    }
}
