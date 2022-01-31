<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ration
 *
 * @ORM\Table(name="ration")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\RationRepository")
 */
class Ration
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
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\TrancheAge", inversedBy="rations")
     * @ORM\JoinColumn(name="tranche_age_id" , referencedColumnName="id")
     */
    private $trancheAge;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\TypeVache", inversedBy="rations")
     * @ORM\JoinColumn(name="type_vache_id" , referencedColumnName="id")
     */
    private $typeVache;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Aliment", inversedBy="rations")
     * @ORM\JoinColumn(name="aliment_id" , referencedColumnName="id")
     */
    private $aliment;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Race", inversedBy="rations")
     * @ORM\JoinColumn(name="race_id" , referencedColumnName="id")
     */
    private $race;
    /**
     * @var string
     *
     * @ORM\Column(name="qteADistribuer", type="decimal", precision=10, scale=0)
     */
    private $qteADistribuer;


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
     * Set qteADistribuer
     *
     * @param string $qteADistribuer
     *
     * @return Ration
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
     * Set trancheAge
     *
     * @param \Pfe\SuiviVacheBundle\Entity\TrancheAge $trancheAge
     *
     * @return Ration
     */
    public function setTrancheAge(\Pfe\SuiviVacheBundle\Entity\TrancheAge $trancheAge = null)
    {
        $this->trancheAge = $trancheAge;

        return $this;
    }

    /**
     * Get trancheAge
     *
     * @return \Pfe\SuiviVacheBundle\Entity\TrancheAge
     */
    public function getTrancheAge()
    {
        return $this->trancheAge;
    }

    /**
     * Set typeVache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\TypeVache $typeVache
     *
     * @return Ration
     */
    public function setTypeVache(\Pfe\SuiviVacheBundle\Entity\TypeVache $typeVache = null)
    {
        $this->typeVache = $typeVache;

        return $this;
    }

    /**
     * Get typeVache
     *
     * @return \Pfe\SuiviVacheBundle\Entity\TypeVache
     */
    public function getTypeVache()
    {
        return $this->typeVache;
    }

    /**
     * Set aliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Aliment $aliment
     *
     * @return Ration
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
     * Set race
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Race $race
     *
     * @return Ration
     */
    public function setRace(\Pfe\SuiviVacheBundle\Entity\Race $race = null)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Race
     */
    public function getRace()
    {
        return $this->race;
    }
}
