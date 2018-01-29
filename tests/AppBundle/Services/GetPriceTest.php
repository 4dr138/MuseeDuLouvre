<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 25/01/2018
 * Time: 18:38
 */

namespace tests\AppBundle\Services;


use AppBundle\Entity\Billet;
use AppBundle\Entity\Price;
use AppBundle\Repository\PriceRepository;
use AppBundle\Service\PriceBillet;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;


class GetPriceTest extends TestCase
{
    /**
     * @var $PriceBillet
     */
    private $PriceBillet;

    protected function setUp()
    {
        $prix = new Price();
        $prix->setTarif('normal');
        $prixRepository = $this
            ->getMockBuilder(PriceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $prixRepository->expects($this->any())
            ->method('find')
            ->will($this->returnValue($prix));

        $container = $this
            ->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container->expects($this->any())
            ->method('getPrice')
            ->will($this->returnValue($prixRepository));

        $this->service = new PriceBillet($container);

    }

    public function testPrix()
    {
        $billet = new Billet();
        $billet->setDiscount(false);
        $billet->setBirthdate(new \DateTime('1950-01-01'));

        $this->assertEquals(12, $this->PriceBillet->getPriceBillet($billet, true));
    }


}