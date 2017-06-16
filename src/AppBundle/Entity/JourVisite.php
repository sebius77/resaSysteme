<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JourVisite
 *
 * @ORM\Table(name="Jour_visite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JourVisiteRepository")
 */
class JourVisite
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateVisite", type="datetime", unique=true)
     */
    private $dateVisite;

    /**
     * @var int
     *
     * @ORM\Column(name="billets_restants", type="integer")
     */
    private $billetsRestants = 1000;


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
     * Set dateVisite
     *
     * @param \DateTime $dateVisite
     *
     * @return jourVisite
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get dateVisite
     *
     * @return \DateTime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }


    /**
     * Set billetsRestants
     *
     * @param integer $billetsRestants
     *
     * @return JourVisite
     */
    public function setBilletsRestants($billetsRestants)
    {
        $this->billetsRestants = $billetsRestants;

        return $this;
    }

    /**
     * Get billetsRestants
     *
     * @return integer
     */
    public function getBilletsRestants()
    {
        return $this->billetsRestants;
    }
}
