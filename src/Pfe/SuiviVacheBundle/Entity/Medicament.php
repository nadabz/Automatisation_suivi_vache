<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicament
 *
 * @ORM\Table(name="medicament")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\MedicamentRepository")
 */
class Medicament
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
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Dose", mappedBy="medicament",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $doses;


    /**
     * Get liste catégorie medicament
     *
     * @return array
     */
    public function getListeCategorieMedicament()
    {
        return [
            'allergie'=>'Allèrgie',
            'grippe'=>'Grippe'
        ];
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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Medicament
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Medicament
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
     * Constructor
     */
    public function __construct()
    {
        $this->doses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dose
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Dose $dose
     *
     * @return Medicament
     */
    public function addDose(\Pfe\SuiviVacheBundle\Entity\Dose $dose)
    {
        $this->doses[] = $dose;

        return $this;
    }

    /**
     * Remove dose
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Dose $dose
     */
    public function removeDose(\Pfe\SuiviVacheBundle\Entity\Dose $dose)
    {
        $this->doses->removeElement($dose);
    }

    /**
     * Get doses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDoses()
    {
        return $this->doses;
    }
}
