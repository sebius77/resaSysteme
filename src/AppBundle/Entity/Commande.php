<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var int
     *
     * @ORM\OneToMany(targetEntity="Billet", mappedBy="Commande")
     *
     *
     */
    private $billets;

    /**
     * @var int
     *
     * @ORM\Column(name="prixCommande", type="integer")
     */
    private $prixCommande;



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
     * Set nbreBillet
     *
     * @param integer $nbreBillet
     *
     * @return Commande
     */
    public function setNbreBillet($nbreBillet)
    {
        $this->nbreBillet = $nbreBillet;

        return $this;
    }

    /**
     * Get nbreBillet
     *
     * @return integer
     */
    public function getNbreBillet()
    {
        return $this->nbreBillet;
    }

    /**
     * Set prixCommande
     *
     * @param integer $prixCommande
     *
     * @return Commande
     */
    public function setPrixCommande($prixCommande)
    {
        $this->prixCommande = $prixCommande;

        return $this;
    }

    /**
     * Get prixCommande
     *
     * @return integer
     */
    public function getPrixCommande()
    {
        return $this->prixCommande;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->billets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add billet
     *
     * @param \AppBundle\Entity\Billet $billet
     *
     * @return Commande
     */
    public function addBillet(\AppBundle\Entity\Billet $billet)
    {
        $this->billets[] = $billet;

        return $this;
    }

    /**
     * Remove billet
     *
     * @param \AppBundle\Entity\Billet $billet
     */
    public function removeBillet(\AppBundle\Entity\Billet $billet)
    {
        $this->billets->removeElement($billet);
    }

    /**
     * Get billets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillets()
    {
        return $this->billets;
    }
}
