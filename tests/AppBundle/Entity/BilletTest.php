<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 25/01/2018
 * Time: 18:38
 */

namespace tests\AppBundle\Entity;

use AppBundle\Entity\Billet;
use PHPUnit\Framework\TestCase;

class BilletTest extends TestCase
{
    public function testName()
    {
        $billet = new Billet();

        $billet->setName('Gautier');
        $billet->setBirthdate('31/12/1994');
        $billet->setPrice(15);
        $billet->setCountry('France');
        $billet->setDiscount(true);
        $billet->setFirstname('Adrien');

        $this->assertEquals('Gautier', $billet->getName());
        $this->assertEquals('31/12/1994', $billet->getBirthdate());
        $this->assertEquals(15, $billet->getPrice());
        $this->assertEquals('France', $billet->getCountry());
        $this->assertEquals(true, $billet->getDiscount());
        $this->assertEquals('Adrien', $billet->getFirstname());

    }
}