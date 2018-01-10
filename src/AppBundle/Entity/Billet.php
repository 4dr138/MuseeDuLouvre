<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BilletRepository")
 */
class Billet
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
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit au moins faire {{ limit }} caractères.",
     *      maxMessage = "Votre nom ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit au moins faire {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $country;

    /**
     * @var discount
     *
     * @ORM\Column(name="discount", type="boolean", options={"default": false})
     */
    private $discount;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Basket", inversedBy="billet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Basket;

    public function __construct()
    {
      $this->birthdate = new \DateTime();
    }



    /**
     * @return mixed
     */
    public function getBasket()
    {
        return $this->Basket;
    }

    /**
     * @param mixed $Basket
     */
    public function setBasket($Basket)
    {
        $this->Basket = $Basket;
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
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Billet
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Billet
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Billet
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Billet
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set discount
     *
     * @param string $discount
     *
     * @return Billet
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
