<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table(name="price")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PriceRepository")
 */
class Price
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
     * @ORM\Column(name="normal", type="integer")
     */
    private $normal;

    /**
     * @var int
     *
     * @ORM\Column(name="senior", type="integer")
     */
    private $senior;

    /**
     * @var int
     *
     * @ORM\Column(name="enfant", type="integer")
     */
    private $enfant;

    /**
     * @var int
     *
     * @ORM\Column(name="bebe", type="integer")
     */
    private $bebe;

    /**
     * @var int
     *
     * @ORM\Column(name="reduit", type="integer")
     */
    private $reduit;

    public function __construct()
    {
        $this->normal = 16;
        $this->senior = 12;
        $this->enfant = 8;
        $this->bebe = 0;
        $this->reduit = 10;
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
     * Set normal
     *
     * @param integer $normal
     *
     * @return Price
     */
    public function setNormal($normal)
    {
        $this->normal = $normal;

        return $this;
    }

    /**
     * Get normal
     *
     * @return int
     */
    public function getNormal()
    {
        return $this->normal;
    }

    /**
     * Set senior
     *
     * @param integer $senior
     *
     * @return Price
     */
    public function setSenior($senior)
    {
        $this->senior = $senior;

        return $this;
    }

    /**
     * Get senior
     *
     * @return int
     */
    public function getSenior()
    {
        return $this->senior;
    }

    /**
     * Set enfant
     *
     * @param integer $enfant
     *
     * @return Price
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return int
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * Set bebe
     *
     * @param integer $bebe
     *
     * @return Price
     */
    public function setBebe($bebe)
    {
        $this->bebe = $bebe;

        return $this;
    }

    /**
     * Get bebe
     *
     * @return int
     */
    public function getBebe()
    {
        return $this->bebe;
    }

    /**
     * Set reduit
     *
     * @param integer $reduit
     *
     * @return Price
     */
    public function setReduit($reduit)
    {
        $this->reduit = $reduit;

        return $this;
    }

    /**
     * Get reduit
     *
     * @return int
     */
    public function getReduit()
    {
        return $this->reduit;
    }
}
