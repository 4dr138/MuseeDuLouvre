<?php

namespace tests\AppBundle\Form;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BasketFormTest extends WebTestCase
{
    public function testBasketForm()
    {
        $client = static::createClient();
        $crawler = $client->request("POST", '/');
        $this->assertEquals(1, $crawler->filter('h1:contains("Formulaire")')->count());

        $form = $crawler->selectButton('#appbundle_basket_payer')->form();

        $form->setValues(array(
            'appbundle_basket[mail]' => "agautier38@gmail.com",
            'appbundle_basket[type]' => true,
            'appbundle_basket[date]' => '25/01/2018',
            'appbundle_basket_billet' => null
        ));

        $client->submit($form);
        $response = $client->getResponse();

        $this->assertEquals(0, $crawler->filter('.flash-notice:contains("Désolé mais le maximum des places a été atteint")')->count());
    }

}