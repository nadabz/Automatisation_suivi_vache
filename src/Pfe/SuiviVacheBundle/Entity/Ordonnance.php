<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ordonnance
 *
 * @ORM\Table(name="ordonnance")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\OrdonnanceRepository")
 */
class Ordonnance
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
     * @ORM\Column(name="date_ordonnance", type="datetime", nullable=true)
     */
    private $dateOrdonnance;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Consultation", inversedBy="ordonnances")
     * @ORM\JoinColumn(name="consultation_id" , referencedColumnName="id")
     */
    private $consultation;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Medicament", mappedBy="ordonnance",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $medicaments;
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->dateOrdonnance = new \DateTime();
    }

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Dose", mappedBy="ordonnance",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $doses;


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
     * Set dateOrdonnance
     *
     * @param \DateTime $dateOrdonnance
     *
     * @return Ordonnance
     */

    public function setDateOrdonnance($dateOrdonnance)
    {
        $this->dateOrdonnance = $dateOrdonnance;

        return $this;
    }


    /**
     * Get dateOrdonnance
     *
     * @return \DateTime
     */
    public function getDateOrdonnance()
    {
        return $this->dateOrdonnance;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medicaments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set consultation
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Consultation $consultation
     *
     * @return Ordonnance
     */
    public function setConsultation(\Pfe\SuiviVacheBundle\Entity\Consultation $consultation = null)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * Get consultation
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * Add medicament
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Medicaments $medicament
     *
     * @return Ordonnance
     */
    public function addMedicament(\Pfe\SuiviVacheBundle\Entity\Medicaments $medicament)
    {
        $this->medicaments[] = $medicament;

        return $this;
    }

    /**
     * Remove medicament
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Medicaments $medicament
     */
    public function removeMedicament(\Pfe\SuiviVacheBundle\Entity\Medicaments $medicament)
    {
        $this->medicaments->removeElement($medicament);
    }

    /**
     * Get medicaments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedicaments()
    {
        return $this->medicaments;
    }

    /**
     * Add dose
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Dose $dose
     *
     * @return Ordonnance
     */
    public function addDose(\Pfe\SuiviVacheBundle\Entity\Dose $dose)
    {
        $this->doses[] = $dose;

        return $this;
    }

    /**
     * Remove dose
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Dose $dose
     */
    public function removeDose(\Pfe\SuiviVacheBundle\Entity\Dose $dose)
    {
        $this->doses->removeElement($dose);
    }

    /**
     * Get doses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDoses()
    {
        return $this->doses;
    }
}
