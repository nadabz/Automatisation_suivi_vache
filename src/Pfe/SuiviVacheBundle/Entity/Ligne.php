<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table(name="ligne")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\LigneRepository")
 */
class Ligne
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
     * @var float
     *
     * @ORM\Column(name="qterecu", type="float")
     */
    private $qterecu;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Reception", inversedBy="lignes")
     * @ORM\JoinColumn(name="reception_id" , referencedColumnName="id")
     */
    private $reception;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Aliment", inversedBy="lignes")
     * @ORM\JoinColumn(name="aliment_id" , referencedColumnName="id")
     */
    private $aliment;
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
     * Set qterecu
     *
     * @param float $qterecu
     *
     * @return Ligne
     */
    public function setQterecu($qterecu)
    {
        $this->qterecu = $qterecu;

        return $this;
    }

    /**
     * Get qterecu
     *
     * @return float
     */
    public function getQterecu()
    {
        return $this->qterecu;
    }

    /**
     * Set reception
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Reception $reception
     *
     * @return Ligne
     */
    public function setReception(\Pfe\SuiviVacheBundle\Entity\Reception $reception = null)
    {
        $this->reception = $reception;

        return $this;
    }

    /**
     * Get reception
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Reception
     */
    public function getReception()
    {
        return $this->reception;
    }

    /**
     * Set aliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Aliment $aliment
     *
     * @return Ligne
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
}
