<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dose
 *
 * @ORM\Table(name="dose")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\DoseRepository")
 */
class Dose
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
     * @ORM\Column(name="dose", type="string", length=255)
     */
    private $dose;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Ordonnance", inversedBy="doses")
     * @ORM\JoinColumn(name="ordonnance_id" , referencedColumnName="id")
     */
    private $ordonnance;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Medicament", inversedBy="doses")
     * @ORM\JoinColumn(name="medicament_id" , referencedColumnName="id")
     */
    private $medicament;


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
     * Set ordonnance
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ordonnance $ordonnance
     *
     * @return Dose
     */
    public function setOrdonnance(\Pfe\SuiviVacheBundle\Entity\Ordonnance $ordonnance = null)
    {
        $this->ordonnance = $ordonnance;

        return $this;
    }

    /**
     * Get ordonnance
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Ordonnance
     */
    public function getOrdonnance()
    {
        return $this->ordonnance;
    }

    /**
     * Set medicament
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Medicament $medicament
     *
     * @return Dose
     */
    public function setMedicament(\Pfe\SuiviVacheBundle\Entity\Medicament $medicament = null)
    {
        $this->medicament = $medicament;

        return $this;
    }

    /**
     * Get medicament
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Medicament
     */
    public function getMedicament()
    {
        return $this->medicament;
    }

    /**
     * Set dose
     *
     * @param string $dose
     *
     * @return Dose
     */
    public function setDose($dose)
    {
        $this->dose = $dose;

        return $this;
    }

    /**
     * Get dose
     *
     * @return string
     */
    public function getDose()
    {
        return $this->dose;
    }
}
