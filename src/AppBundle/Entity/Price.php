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
     * @var string
     *
     * @ORM\Column(name="billetprice", type="decimal", precision=5, scale=2)
     */
    private $billetprice;


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
     * Set billetprice
     *
     * @param string $billetprice
     *
     * @return Price
     */
    public function setBilletprice($billetprice)
    {
        $this->billetprice = $billetprice;

        return $this;
    }

    /**
     * Get billetprice
     *
     * @return string
     */
    public function getBilletprice()
    {
        return $this->billetprice;
    }
}
