<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etable
 *
 * @ORM\Table(name="etable")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\EtableRepository")
 */
class Etable
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
     * @ORM\Column(name="Numero", type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Lot", mappedBy="etable",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $lots;


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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Etable
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
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
     * @return Etable
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
}
