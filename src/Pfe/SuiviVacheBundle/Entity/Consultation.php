<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultation
 *
 * @ORM\Table(name="consultation")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\ConsultationRepository")
 */
class Consultation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id; /**


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_consultation", type="datetime")
     */
    private $dateConsultation;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255)
     */
    private $observation;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Gestion\UserBundle\Entity\User", inversedBy="consultations")
     * @ORM\JoinColumn(name="user_id" , referencedColumnName="id")
     */
    private $user;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", inversedBy="consultations")
     * @ORM\JoinColumn(name="vache_id" , referencedColumnName="id")
     */
    private $vache;
    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Ordonnance", mappedBy="consultation",cascade={"persist", "remove"})
     */
    private $ordonnance;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->dateConsultation = new \DateTime();
    }
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->dateConsultation = new \DateTime();
    }

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
     * Set observation
     *
     * @param string $observation
     *
     * @return Consultation
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set user
     *
     * @param \Gestion\UserBundle\Entity\User $user
     *
     * @return Consultation
     */
    public function setUser(\Gestion\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Gestion\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set vache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vache
     *
     * @return Consultation
     */
    public function setVache(\Pfe\SuiviVacheBundle\Entity\Vache $vache = null)
    {
        $this->vache = $vache;

        return $this;
    }

    /**
     * Get vache
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Vache
     */
    public function getVache()
    {
        return $this->vache;
    }

    /**
     * Set dateConsultation
     *
     * @param \DateTime $dateConsultation
     *
     * @return Consultation
     */
    public function setDateConsultation($dateConsultation)
    {
        $this->dateConsultation = $dateConsultation;

        return $this;
    }

    /**
     * Get dateConsultation
     *
     * @return \DateTime
     */
    public function getDateConsultation()
    {
        return $this->dateConsultation;
    }
    

    /**
     * Set ordonnance
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ordonnance $ordonnance
     *
     * @return Consultation
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
}
