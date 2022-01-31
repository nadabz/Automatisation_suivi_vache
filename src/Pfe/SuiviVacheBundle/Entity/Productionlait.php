<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productionlait
 *
 * @ORM\Table(name="productionlait")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\ProductionlaitRepository")
 */
class Productionlait
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
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", inversedBy="productionLaits")
     * @ORM\JoinColumn(name="vache_id" , referencedColumnName="id")
     */
    private $vache;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="qtelait", type="decimal", precision=10, scale=0)
     */
    private $qtelait;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Productionlait
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set qtelait
     *
     * @param string $qtelait
     *
     * @return Productionlait
     */
    public function setQtelait($qtelait)
    {
        $this->qtelait = $qtelait;

        return $this;
    }

    /**
     * Get qtelait
     *
     * @return string
     */
    public function getQtelait()
    {
        return $this->qtelait;
    }


    /**
     * Set vache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vache
     *
     * @return Productionlait
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
}
