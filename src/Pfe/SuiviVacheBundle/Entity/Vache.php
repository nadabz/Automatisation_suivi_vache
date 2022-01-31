<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vache
 *
 * @ORM\Table(name="vache")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\VacheRepository")
 */
class Vache
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
     * @ORM\Column(name="age", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplir le champs age")
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Age invalide"
     * )
     */
    private $age;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", unique=true, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="poid_naissance", type="decimal", precision=10, scale=2, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[1-9]+$/",
     *     message="Poids invalide"
     * )
     */
    private $poidNaissance;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Lot", inversedBy="Vaches")
     * @ORM\JoinColumn(name="lot_id" , referencedColumnName="id")
     */
    private $lot;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Fournisseur", inversedBy="Vaches")
     * @ORM\JoinColumn(name="fournisseur_id" , referencedColumnName="id")
     */
    private $fournisseur;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\SuiviPoids", mappedBy="vache",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $suiviPoids;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Productionlait", mappedBy="vache",cascade={"persist", "remove"})
     *
     */

    private $productionLaits;

    /**     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Consultation", mappedBy="vache",cascade={"persist", "remove"})
     */
    private $consultations;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\DistrubtionAliment", mappedBy="vache",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $distrubtionAliments;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\TypeVache", inversedBy="Vaches")
     * @ORM\JoinColumn(name="type_vache_id" , referencedColumnName="id")
     *      * @Assert\NotBlank(message="Choisissez un type de vache")

     */
    private $typeVache;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Race", inversedBy="Vaches")
     * @ORM\JoinColumn(name="race_id" , referencedColumnName="id")
     * @Assert\NotBlank(message="Choisissez une race")
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", inversedBy="VacheEnfants")
     * @ORM\JoinColumn(name="vache_mere_id" , referencedColumnName="id")
     */
    private $vacheMere;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", mappedBy="vacheMere",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $VacheEnfants;

    

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Vache
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Vache
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Vache
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set poidNaissance
     *
     * @param string $poidNaissance
     *
     * @return Vache
     */
    public function setPoidNaissance($poidNaissance)
    {
        $this->poidNaissance = $poidNaissance;

        return $this;
    }

    /**
     * Get poidNaissance
     *
     * @return string
     */
    public function getPoidNaissance()
    {
        return $this->poidNaissance;
    }


    /**
     * Set lot
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Lot $lot
     *
     * @return Vache
     */
    public function setLot(\Pfe\SuiviVacheBundle\Entity\Lot $lot = null)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * Get lot
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Lot
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->suiviPoids = new \Doctrine\Common\Collections\ArrayCollection();
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add suiviPoid
     *
     * @param \Pfe\SuiviVacheBundle\Entity\SuiviPoids $suiviPoid
     *
     * @return Vache
     */
    public function addSuiviPoid(\Pfe\SuiviVacheBundle\Entity\SuiviPoids $suiviPoid)
    {
        $this->suiviPoids[] = $suiviPoid;

        return $this;
    }

    /**
     * Remove suiviPoid
     *
     * @param \Pfe\SuiviVacheBundle\Entity\SuiviPoids $suiviPoid
     */
    public function removeSuiviPoid(\Pfe\SuiviVacheBundle\Entity\SuiviPoids $suiviPoid)
    {
        $this->suiviPoids->removeElement($suiviPoid);
    }

    /**
     * Get suiviPoids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuiviPoids()
    {
        return $this->suiviPoids;
    }

    /**
     * Add consultation
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Consultation $consultation
     *
     * @return Vache
     */
    public function addConsultation(\Pfe\SuiviVacheBundle\Entity\Consultation $consultation)
    {
        $this->consultations[] = $consultation;

        return $this;
    }

    /**
     * Remove consultation
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Consultation $consultation
     */
    public function removeConsultation(\Pfe\SuiviVacheBundle\Entity\Consultation $consultation)
    {
        $this->consultations->removeElement($consultation);
    }

    /**
     * Get consultations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsultations()
    {
        return $this->consultations;
    }

    


    /**
     * Add distrubtionAliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distrubtionAliment
     *
     * @return Vache
     */
    public function addDistrubtionAliment(\Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distrubtionAliment)
    {
        $this->distrubtionAliments[] = $distrubtionAliment;

        return $this;
    }

    /**
     * Remove distrubtionAliment
     *
     * @param \Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distrubtionAliment
     */
    public function removeDistrubtionAliment(\Pfe\SuiviVacheBundle\Entity\DistrubtionAliment $distrubtionAliment)
    {
        $this->distrubtionAliments->removeElement($distrubtionAliment);
    }

    /**
     * Get distrubtionAliments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDistrubtionAliments()
    {
        return $this->distrubtionAliments;
    }

    /**
     * Set typeVache
     *
     * @param \Pfe\SuiviVacheBundle\Entity\TypeVache $typeVache
     *
     * @return Vache
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
     * Set race
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Race $race
     *
     * @return Vache
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
     * Set vacheMere
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vacheMere
     *
     * @return Vache
     */
    public function setVacheMere(\Pfe\SuiviVacheBundle\Entity\Vache $vacheMere = null)
    {
        $this->vacheMere = $vacheMere;

        return $this;
    }

    /**
     * Get vacheMere
     *
     * @return \Pfe\SuiviVacheBundle\Entity\Vache
     */
    public function getVacheMere()
    {
        return $this->vacheMere;
    }

    /**
     * Add vacheEnfant
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vacheEnfant
     *
     * @return Vache
     */
    public function addVacheEnfant(\Pfe\SuiviVacheBundle\Entity\Vache $vacheEnfant)
    {
        $this->VacheEnfants[] = $vacheEnfant;

        return $this;
    }

    /**
     * Remove vacheEnfant
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vacheEnfant
     */
    public function removeVacheEnfant(\Pfe\SuiviVacheBundle\Entity\Vache $vacheEnfant)
    {
        $this->VacheEnfants->removeElement($vacheEnfant);
    }

    /**
     * Get vacheEnfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVacheEnfants()
    {
        return $this->VacheEnfants;
    }




    /**
     * Add productionLait
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Productionlait $productionLait
     *
     * @return Vache
     */
    public function addProductionLait(\Pfe\SuiviVacheBundle\Entity\Productionlait $productionLait)
    {
        $this->productionLaits[] = $productionLait;

        return $this;
    }

    /**
     * Remove productionLait
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Productionlait $productionLait
     */
    public function removeProductionLait(\Pfe\SuiviVacheBundle\Entity\Productionlait $productionLait)
    {
        $this->productionLaits->removeElement($productionLait);
    }

    /**
     * Get productionLaits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductionLaits()
    {
        return $this->productionLaits;
    }


    /**
     * Set fournisseur
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Fournisseur $fournisseur
     *
     * @return Vache
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
}
