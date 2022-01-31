<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Lot
 *
 * @ORM\Table(name="lot")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\LotRepository")
 */
class Lot
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
     * @ORM\Column(name="nbre_vache", type="integer", nullable=true)
     */
    private $nbreVache;

    /**
     * @var int
     *
     * @ORM\Column(name="num_lot", type="integer")
     */
    private $numLot;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\TypeVache", inversedBy="lots")
     * @ORM\JoinColumn(name="type_vache_id" , referencedColumnName="id")
     * @Assert\NotBlank(message="Choisissez un type de vache")

     */
    private $typeVache;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\TrancheAge", inversedBy="lots")
     * @ORM\JoinColumn(name="tranche_age_id" , referencedColumnName="id")
      * @Assert\NotBlank(message="Choisissez un tranche d'age")

     */
    private $trancheAge;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Race", inversedBy="lots")
     * @ORM\JoinColumn(name="race_id" , referencedColumnName="id")
       * @Assert\NotBlank(message="Choisissez un race")

     */
    private $race;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Etable", inversedBy="lots")
     * @ORM\JoinColumn(name="etable_id" , referencedColumnName="id")
   * @Assert\NotBlank(message="Choisissez un étable")

     */
    private $etable;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", mappedBy="lot",cascade={"persist", "remove"})
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
     * Set nbreVache
     *
     * @param integer $nbreVache
     *
     * @return Lot
     */
    public function setNbreVache($nbreVache)
    {
        $this->nbreVache = $nbreVache;

        return $this;
    }

    /**
     * Get nbreVache
     *
     * @return int
     */
    public function getNbreVache()
    {
        return $this->nbreVache;
    }

    /**
     * Set numLot
     *
     * @param integer $numLot
     *
     * @return Lot
     */
    public function setNumLot($numLot)
    {
        $this->numLot = $numLot;

        return $this;
    }

    /**
     * Get numLot
     *
     * @return int
     */
    public function getNumLot()
    {
        return $this->numLot;
    }

    /**
     * Set typeVache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\TypeVache $typeVache
     *
     * @return Lot
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
     * Set trancheAge
     *
     * @param \Pfe\SuiviVacheBundle\Entity\TrancheAge $trancheAge
     *
     * @return Lot
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
     * Set race
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Race $race
     *
     * @return Lot
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

    /**
     * Set etable
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Etable $etable
     *
     * @return Lot
     */
    public function setEtable(\Pfe\SuiviVacheBundle\Entity\Etable $etable = null)
    {
        $this->etable = $etable;

        return $this;
    }

    /**
     * Get etable
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Etable
     */
    public function getEtable()
    {
        return $this->etable;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vaches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vach
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vach
     *
     * @return Lot
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
