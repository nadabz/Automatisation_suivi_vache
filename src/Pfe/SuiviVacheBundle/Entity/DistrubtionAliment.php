<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DistrubtionAliment
 *
 * @ORM\Table(name="distrubtion_aliment")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\DistrubtionAlimentRepository")
 */
class DistrubtionAliment
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
     * @ORM\Column(name="date_distribution", type="date")
     */
    private $dateDistribution;

    /**
     * @var string
     *
     * @ORM\Column(name="qteDistribue", type="decimal", precision=10, scale=0)
     */
    private $qteDistribue;

    /**
     * @var string
     *
     * @ORM\Column(name="qteADistribuer", type="decimal", precision=10, scale=0)
     */
    private $qteADistribuer;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Aliment", inversedBy="distributionAliments")
     * @ORM\JoinColumn(name="aliment_id" , referencedColumnName="id")
     */
    private $aliment;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", inversedBy="distrubtionAliments")
     * @ORM\JoinColumn(name="vache_id" , referencedColumnName="id")
     */
    private $vache;

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
     * Set qteDistribue
     *
     * @param string $qteDistribue
     *
     * @return DistrubtionAliment
     */
    public function setQteDistribue($qteDistribue)
    {
        $this->qteDistribue = $qteDistribue;

        return $this;
    }

    /**
     * Get qteDistribue
     *
     * @return string
     */
    public function getQteDistribue()
    {
        return $this->qteDistribue;
    }

    /**
     * Set qteADistribuer
     *
     * @param string $qteADistribuer
     *
     * @return DistrubtionAliment
     */
    public function setQteADistribuer($qteADistribuer)
    {
        $this->qteADistribuer = $qteADistribuer;

        return $this;
    }

    /**
     * Get qteADistribuer
     *
     * @return string
     */
    public function getQteADistribuer()
    {
        return $this->qteADistribuer;
    }

    /**
     * Set aliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Aliment $aliment
     *
     * @return DistrubtionAliment
     */
    public function setAliment(\Pfe\SuiviVacheBundle\Entity\Aliment $aliment = null)
    {
        $this->aliment = $aliment;

        return $this;
    }

    /**
     * Get aliment
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Aliment
     */
    public function getAliment()
    {
        return $this->aliment;
    }

    /**
     * Set dateDistribution
     *
     * @param \DateTime $dateDistribution
     *
     * @return DistrubtionAliment
     */
    public function setDateDistribution($dateDistribution)
    {
        $this->dateDistribution = $dateDistribution;

        return $this;
    }

    /**
     * Get dateDistribution
     *
     * @return \DateTime
     */
    public function getDateDistribution()
    {
        return $this->dateDistribution;
    }


    /**
     * Set vache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vache
     *
     * @return DistrubtionAliment
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
