<?php

namespace Pfe\SuiviVacheBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Aliment
 *
 * @ORM\Table(name="aliment")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\AlimentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Aliment
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
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Remplir le champs age")
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Age invalide"
     * )
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     * @Assert\NotBlank(message="Remplir le champs désignation")
     * @Assert\Regex(
     *     pattern="/^[aA-zZ]+$/",
     *     message="Désignation invalide"
     * )
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="qteStock", type="integer", precision=100, scale=2)
     * @Assert\NotBlank(message="Remplir la quantité stock")
     * @Assert\Regex(
     *     pattern="/^[1-9]{1}[0-9]*$/",
     *     message="Quantité invalide"
     * )

     */
    private $qteStock;

    /**
     * @var string
     *
     * @ORM\Column(name="qteMin", type="integer", precision=100, scale=2)
     * @Assert\NotBlank(message="Remplir la quantité minimale")
     * @Assert\Regex(
     *     pattern="/^[1-9]{1}[0-9]*$/",
     *     message="Quantité invalide"
     * )


     */
    private $qteMin;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Ration", mappedBy="aliment",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */

    private $rations;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\DistrubtionAliment", mappedBy="aliment",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */

    private $distributionAliments;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Reception", mappedBy="aliment",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $receptions;


    private $code_designation;

    /**
     * @Assert\Callback
     */
    public function verifQteSaisie(ExecutionContextInterface $context)
    {
        if ($this->getQteMin() > $this->getQteStock()) {
            $context->buildViolation('La qte min doit être inf. ala qte stock')
                ->atPath('qteMin')
                ->addViolation();
        }
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
     * Set code
     *
     * @param string $code
     *
     * @return Aliment
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Aliment
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set qteStock
     *
     * @param string $qteStock
     *
     * @return Aliment
     */
    public function setQteStock($qteStock)
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    /**
     * Get qteStock
     *
     * @return string
     */
    public function getQteStock()
    {
        return $this->qteStock;
    }

    /**
     * Set qteMin
     *
     * @param string $qteMin
     *
     * @return Aliment
     */
    public function setQteMin($qteMin)
    {
        $this->qteMin = $qteMin;

        return $this;
    }

    /**
     * Get qteMin
     *
     * @return string
     */
    public function getQteMin()
    {
        return $this->qteMin;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ration
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ration $ration
     *
     * @return Aliment
     */
    public function addRation(\Pfe\SuiviVacheBundle\Entity\Ration $ration)
    {
        $this->rations[] = $ration;

        return $this;
    }

    /**
     * Remove ration
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Ration $ration
     */
    public function removeRation(\Pfe\SuiviVacheBundle\Entity\Ration $ration)
    {
        $this->rations->removeElement($ration);
    }

    /**
     * Get rations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRations()
    {
        return $this->rations;
    }


    /**
     * Add distributionAliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distributionAliment
     *
     * @return Aliment
     */
    public function addDistributionAliment(\Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distributionAliment)
    {
        $this->distributionAliments[] = $distributionAliment;

        return $this;
    }

    /**
     * Remove distributionAliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distributionAliment
     */
    public function removeDistributionAliment(\Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distributionAliment)
    {
        $this->distributionAliments->removeElement($distributionAliment);
    }

    /**
     * Get distributionAliments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDistributionAliments()
    {
        return $this->distributionAliments;
    }

    /**
     * Get code_designation
     *
     * @return string
     */
    public function getCodeDesignation()
    {
        return $this->code . " - " . $this->designation;
    }

    /**
     * Add reception
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Reception $reception
     *
     * @return Aliment
     */
    public function addReception(\Pfe\SuiviVacheBundle\Entity\Reception $reception)
    {
        $this->receptions[] = $reception;

        return $this;
    }

    /**
     * Remove reception
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Reception $reception
     */
    public function removeReception(\Pfe\SuiviVacheBundle\Entity\Reception $reception)
    {
        $this->receptions->removeElement($reception);
    }

    /**
     * Get receptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReceptions()
    {
        return $this->receptions;
    }

}
