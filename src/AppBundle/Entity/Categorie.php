<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="tarif", type="integer")
     */
    private $tarif;


    /**
     * @ORM\OneToMany(targetEntity="Billet", mappedBy="Categorie")
     */
    private $billet;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set tarif
     *
     * @param integer $tarif
     *
     * @return Categorie
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return int
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->billet = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add billet
     *
     * @param \AppBundle\Entity\Billet $billet
     *
     * @return Categorie
     */
    public function addBillet(\AppBundle\Entity\Billet $billet)
    {
        $this->billet[] = $billet;

        return $this;
    }

    /**
     * Remove billet
     *
     * @param \AppBundle\Entity\Billet $billet
     */
    public function removeBillet(\AppBundle\Entity\Billet $billet)
    {
        $this->billet->removeElement($billet);
    }

    /**
     * Get billet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillet()
    {
        return $this->billet;
    }
}
