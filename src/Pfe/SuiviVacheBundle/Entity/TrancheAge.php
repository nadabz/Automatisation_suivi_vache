<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * TrancheAge
 *
 * @ORM\Table(name="tranche_age")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\TrancheAgeRepository")
 */
class TrancheAge
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
     * @ORM\Column(name="min_age", type="string", length=255)
     * @Assert\NotBlank(message="Remplir le champs age")
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Age invalide"
     * )
     */
    private $min_age;

    /**
     * @var string
     *
     * @ORM\Column(name="max_age", type="string", length=255)
     * @Assert\NotBlank(message="Remplir le champs age")
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Age invalide"
     * )
     */
    private $max_age;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Lot", mappedBy="trancheAge",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $lots;

    private $libTrancheAge;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Ration", mappedBy="trancheAge",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $rations;

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
     * Set minAge
     *
     * @param string $minAge
     *
     * @return TrancheAge
     */
    public function setMinAge($minAge)
    {
        $this->min_age = $minAge;

        return $this;
    }

    /**
     * Get minAge
     *
     * @return string
     */
    public function getMinAge()
    {
        return $this->min_age;
    }

    /**
     * Set maxAge
     *
     * @param string $maxAge
     *
     * @return TrancheAge
     */
    public function setMaxAge($maxAge)
    {
        $this->max_age = $maxAge;

        return $this;
    }

    /**
     * Get maxAge
     *
     * @return string
     */
    public function getMaxAge()
    {
        return $this->max_age;
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
     * @return TrancheAge
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
     * Get maxAge
     *
     * @return string
     */
    public function getLibTrancheAge()
    {
        return $this->min_age." - ".$this->max_age;
    }


    /**
     * Add ration
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ration $ration
     *
     * @return TrancheAge
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
}
