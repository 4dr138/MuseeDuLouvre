<?php

namespace tests\AppBundle\Paths;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Homepage extends WebTestCase
{
    public function testPathHomepage()
        {
            $client = static::createClient();

            $client->request('GET', '/');

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
}