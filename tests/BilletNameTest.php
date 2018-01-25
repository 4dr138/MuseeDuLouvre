<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 25/01/2018
 * Time: 18:38
 */

use AppBundle\Entity\Billet;
use PHPUnit\Framework\TestCase;

class BilletNameTest extends TestCase
{
    public function testName()
    {
        $billet = new Billet();
        $billet->setName('Adrien');

        $this->assertEquals('Adrien', $billet->getName());
    }
}