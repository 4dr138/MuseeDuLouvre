<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 25/01/2018
 * Time: 18:38
 */

namespace tests\AppBundle\Services;


use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;



class GetPriceTest extends KernelTestCase
{
    /**
     * @var $PriceBillet
     */
    private $PriceBillet;
    /**
     * @var $PriceBillet
     */
    private $dateToday;

    protected function setUp()
    {
        self::bootKernel();
        $this->PriceBillet = static::$kernel->getContainer()->get('appbundle.pricebillet');
        $this->dateToday = new \DateTime();
    }

    public function testPrice()
    {
        $billet = new Billet();
        $basket = new Basket();
        $obj = $this->PriceBillet;

        $billet->setBirthdate(new \DateTime('1950-01-01'));
        $billet->setDiscount(false);
        $result = $this->invokeMethod($obj, 'getPriceBillet', array($billet,$basket));
        $this->assertEquals(12, $result);

        $billet->setBirthdate(new \DateTime('1950-01-01'));
        $billet->setDiscount(true);
        $result = $this->invokeMethod($obj, 'getPriceBillet', array($billet,$basket));
        $this->assertEquals(10, $result);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}