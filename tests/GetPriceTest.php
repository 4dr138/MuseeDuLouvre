<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 25/01/2018
 * Time: 18:38
 */

use AppBundle\Entity\Billet;
use AppBundle\Entity\Basket;
use AppBundle\Service\PriceBillet;
use PHPUnit\Framework\TestCase;


class GetPriceTest extends TestCase
{
    public function testPriceBillet()
    {

        $billet = new Billet();
        $basket = new Basket();
        $billet->setBirthdate(new DateTime('1950-01-01'));
        $billet->setDiscount(true);

        $mock = $this->getMockBuilder(PriceBillet::class)
                     ->disableOriginalConstructor()
                     ->disableOriginalClone()
                     ->disableArgumentCloning()
                     ->disallowMockingUnknownTypes()
                     ->getMock();
        $mock->method('getPriceBillet');
        $this->assertEquals(12, $mock->getPriceBillet($billet, $basket));


//
//        $stub = $this->getMockBuilder(PriceBillet::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        $mock->method('getPriceBillet')
//             ->willReturn(12);
//
//        $this->assertEquals(12, $mock->);
//        $priceBillet = $priceBillet->getPriceBillet($billet, $basket);


//        $this->assertEquals(12, $priceBillet);
    }
}