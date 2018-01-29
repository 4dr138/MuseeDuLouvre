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

        $form = $crawler->selectButton('submit')->form();

        $form['appbundle_basket[mail]'] = "agautier38@gmail.com";
        $form['appbundle_basket[type]'] = true;
        $form['appbundle_basket[date]'] = '25/01/2018';
        $form['appbundle_basket[billet][__name__][name]'] = 'test';

        $crawler = $client->submit($form);

        $this->assertEquals(1, $crawler->filter('.flash-notice:contains("Désolé mais le maximum des places a été atteint")')->count());
    }

}