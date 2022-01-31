<?php

namespace Pfe\SuiviVacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @UniqueEntity(fields="code", message="Le code exite déjà")
 * @ORM\Entity(repositoryClass="Pfe\SuiviVacheBundle\Repository\FournisseurRepository")
 */
class Fournisseur
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
     * @ORM\Column(name="code", type="string", length=255)
     * @Assert\NotBlank(message="Remplir le champs code")
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="code invalide"
     * )
     */
    private $code;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^[aA-zZ]*$/",
     *     message="Nom invalide"
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Reception", mappedBy="fournisseur",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */

    private $receptions;
    /**
     * @ORM\OneToMany(targetEntity="Pfe\SuiviVacheBundle\Entity\Vache", mappedBy="fournisseur",cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    private $vaches;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     * @Assert\Regex(
     *     pattern="/^[0-9]{8}+$/",
     *     message="Désignation invalide"
     * )
     */
    private $tel;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Fournisseur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Fournisseur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return Fournisseur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->receptions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reception
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Reception $reception
     *
     * @return Fournisseur
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

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Fournisseur
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
     * Add vach
     *
     * @param \Pfe\SuiviVacheBundle\Entity\Vache $vach
     *
     * @return Fournisseur
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
