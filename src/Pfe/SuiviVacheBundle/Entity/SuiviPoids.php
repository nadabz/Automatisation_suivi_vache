<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuiviPoids
 *
 * @ORM\Table(name="suivi_poids")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\SuiviPoidsRepository")
 */
class SuiviPoids
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
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", inversedBy="SuiviPoids")
     * @ORM\JoinColumn(name="vache_id" , referencedColumnName="id")
     */
    private $vache;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suivi", type="datetime")
     */
    private $dateSuivi;

    /**
     * @var int
     *
     * @ORM\Column(name="poids_actuel", type="integer")
     */
    private $poidsActuel;


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
     * Set dateSuivi
     *
     * @param \DateTime $dateSuivi
     *
     * @return SuiviPoids
     */
    public function setDateSuivi($dateSuivi)
    {
        $this->dateSuivi = $dateSuivi;

        return $this;
    }

    /**
     * Get dateSuivi
     *
     * @return \DateTime
     */
    public function getDateSuivi()
    {
        return $this->dateSuivi;
    }

    /**
     * Set poidsActuel
     *
     * @param integer $poidsActuel
     *
     * @return SuiviPoids
     */
    public function setPoidsActuel($poidsActuel)
    {
        $this->poidsActuel = $poidsActuel;

        return $this;
    }

    /**
     * Get poidsActuel
     *
     * @return int
     */
    public function getPoidsActuel()
    {
        return $this->poidsActuel;
    }

    /**
     * Set vache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vache
     *
     * @return SuiviPoids
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
