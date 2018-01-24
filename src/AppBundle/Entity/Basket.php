<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Billet;

/**
 * Basket
 *
 * @ORM\Table(name="basket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BasketRepository")
 */
class Basket
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
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     *
     * @Assert\Email(
     *     message = "Le format de l'email n'est pas valide",
     *     checkMX=true
     * )
     */
    private $mail;

    /**
     * @var type
     *
     * @ORM\Column(name="type", type="boolean", options={"default":true})
     */
    private $type;

    /**
     * @var Billet[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Billet", mappedBy="Basket", cascade={"persist"})
     */
    private $billet;

    /**
     * @var int
     *
     * @ORM\Column(name="totalPrice", type="decimal", precision=10, scale=1)
     */
    private $totalPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="totalTTC", type="decimal", precision=10, scale=1)
     */
    private $totalTTC;

    /**
     * @var int
     *
     * @ORM\Column(name="totalTVA", type="decimal", precision=10, scale=1)
     */
    private $totalTVA;

    public function __construct()
    {
      $this->date = new \datetime();
    }

    /**
     * @return Billet[]
     */
    public function getBillet()
    {
        return $this->billet;
    }

    /**
     * @param Billet[] $billet
     *
     *
     */
    public function setBillet($billet)
    {
        $this->billet = $billet;
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
     * Set date
     *
     * @param datetime $date
     *
     * @return Basket
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Basket
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return Basket
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set totalPrice
     *
     * @param int $totalPrice
     *
     * @return Basket
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set totalTTC
     *
     * @param int $totalTTC
     *
     * @return Basket
     */
    public function setTotalTTC($totalTTC)
    {
        $this->totalTTC = $totalTTC;

        return $this;
    }

    /**
     * Get totalTTC
     *
     * @return int
     */
    public function getTotalTTC()
    {
        return $this->totalTTC;
    }

    /**
     * Set totalTVA
     *
     * @param int $totalTVA
     *
     * @return Basket
     */
    public function setTotalTVA($totalTVA)
    {
        $this->totalTVA = $totalTVA;

        return $this;
    }

    /**
     * Get totalTVA
     *
     * @return int
     */
    public function getTotalTVA()
    {
        return $this->totalTVA;
    }
}
