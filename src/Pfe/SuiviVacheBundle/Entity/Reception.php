<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reception
 *
 * @ORM\Table(name="reception")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\ReceptionRepository")
 */
class Reception
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
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Fournisseur", inversedBy="fournisseurs")
     * @ORM\JoinColumn(name="fournisseur_id" , referencedColumnName="id")
     * @Assert\NotBlank(message="Choisir un fournisseur")

     */
    private $fournisseur;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Aliment", inversedBy="receptions")
     * @ORM\JoinColumn(name="aliment_id" , referencedColumnName="id")
     * @Assert\NotBlank(message="Choisir un aliment")

     */
    private $aliment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reception", type="date")
     */
    private $dateReception;

    /**
     * @var string
     *
     * @ORM\Column(name="qteReception", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(message="Remplir la quantité de réception")
     * @Assert\Regex(
     *     pattern="/^[1-9]{1}[0-9]*$/",
     *     message="Quantité invalide"
     * )

     */
    private $qteReception;


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
     * Set dateReception
     *
     * @param \DateTime $dateReception
     *
     * @return Reception
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set fournisseur
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Fournisseur $fournisseur
     *
     * @return Reception
     */
    public function setFournisseur(\Pfe\SuiviVacheBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set aliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Aliment $aliment
     *
     * @return Reception
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
     * Set qteReception
     *
     * @param string $qteReception
     *
     * @return Reception
     */
    public function setQteReception($qteReception)
    {
        $this->qteReception = $qteReception;

        return $this;
    }

    /**
     * Get qteReception
     *
     * @return string
     */
    public function getQteReception()
    {
        return $this->qteReception;
    }
}
