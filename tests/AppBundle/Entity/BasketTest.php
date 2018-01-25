<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 25/01/2018
 * Time: 18:38
 */

use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testPrice()
    {
        $basket = new Basket();
        $basket->setDate(new \DateTime());
        $basket->setTotalTVA(13);
        $basket->setTotalPrice(122.2);
        $basket->setTotalTTC(135.2);
        $basket->setBillet(null);
        $basket->setMail('test@gmail.com');
        $basket->setType(true);


        $this->assertEquals(new \DateTime('25/01/2018'), $basket->getDate());
        $this->assertEquals(13, $basket->getTotalTVA());
        $this->assertEquals(122.2, $basket->getTotalPrice());
        $this->assertEquals(135.2, $basket->getTotalTTC());
        $this->assertEquals(null, $basket->getBillet());
        $this->assertEquals('test@gmail.com', $basket->getMail());
        $this->assertEquals(true, $basket->getType());
    }
}