<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $prixCommande = 0;


    /**
     * 
     * @ORM\Column(name="dateReservation", type="datetime", unique=false)
     * @Assert\DateTime(
     *     format="d/m/Y",
     *     message="Vous devez sélectionner une date"
     * )
     * @Assert\NotBlank(
     *     message="Vous devez sélectionner une date"
     * )
     */
    private $dateReservation;


    /**
     * @var integer
     * @ORM\Column(name="nbreBillet", type="integer", unique=false)
     * @Assert\Range(
     *     min = 1,
     *     max = 10,
     *     minMessage="Votre commande doit contenir au moins 1 billet",
     *     maxMessage="Votre commande ne peux excéder 10 billets"
     * )
     */
    private $nbreBillet;

    /**
     * @var bool
     * @ORM\Column(name="demiJournee", type="boolean", unique=false)
     */
    private $demiJournee = false;


    /**
     * @var
     * @ORM\Column(name="dateCommande", type="datetime", unique=false)
     */
    private $dateCommande;

    /**
     * @var
     * @ORM\Column(name="mail", type="string",length=255, unique=true)
     * @Assert\Email()
     */
    private $mail;

    
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
        $this->dateCommande = new \DateTime();
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

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Commande
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
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
     * Set demiJournee
     *
     * @param boolean $demiJournee
     *
     * @return Commande
     */
    public function setDemiJournee($demiJournee)
    {
        $this->demiJournee = $demiJournee;

        return $this;
    }

    /**
     * Get demiJournee
     *
     * @return boolean
     */
    public function getDemiJournee()
    {
        return $this->demiJournee;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Commande
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
}
