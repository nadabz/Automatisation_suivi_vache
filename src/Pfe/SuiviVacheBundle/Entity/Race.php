<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\RaceRepository")
 */
class Race
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
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Lot", mappedBy="race",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $lots;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Ration", mappedBy="race",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $rations;


    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", mappedBy="race",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $vaches;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Race
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lots = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lot
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Lot $lot
     *
     * @return Race
     */
    public function addLot(\Pfe\SuiviVacheBundle\Entity\Lot $lot)
    {
        $this->lots[] = $lot;

        return $this;
    }

    /**
     * Remove lot
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Lot $lot
     */
    public function removeLot(\Pfe\SuiviVacheBundle\Entity\Lot $lot)
    {
        $this->lots->removeElement($lot);
    }

    /**
     * Get lots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLots()
    {
        return $this->lots;
    }

    /**
     * Add ration
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ration $ration
     *
     * @return Race
     */
    public function addRation(\Pfe\SuiviVacheBundle\Entity\Ration $ration)
    {
        $this->rations[] = $ration;

        return $this;
    }

    /**
     * Remove ration
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ration $ration
     */
    public function removeRation(\Pfe\SuiviVacheBundle\Entity\Ration $ration)
    {
        $this->rations->removeElement($ration);
    }

    /**
     * Get rations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRations()
    {
        return $this->rations;
    }

    /**
     * Add vach
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vach
     *
     * @return Race
     */
    public function addVach(\Pfe\SuiviVacheBundle\Entity\Vache $vach)
    {
        $this->vaches[] = $vach;

        return $this;
    }

    /**
     * Remove vach
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vach
     */
    public function removeVach(\Pfe\SuiviVacheBundle\Entity\Vache $vach)
    {
        $this->vaches->removeElement($vach);
    }

    /**
     * Get vaches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVaches()
    {
        return $this->vaches;
    }
}
