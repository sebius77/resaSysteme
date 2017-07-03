<?php

namespace AppName\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTest extends WebTestCase
{
    public function testPageIsSuccesful()
    {
        $client = static::createClient();

        foreach ($this->provideUrls() as $url) {
            $client->request('GET', $url);
            $this->assertTrue($client->getResponse()->isSuccessful());
        }

    }

    private function provideUrls()
    {
        return array(
            '/',
            '/ticketing'

        );
    }
}