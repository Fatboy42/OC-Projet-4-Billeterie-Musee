<?php 

namespace Tests\MLFrontBundle\HTTPCode;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class HTTPCodeTest extends WebTestCase
{
	public function testHttpCode()
	{
		$client = static::createClient();

		$client->request('GET', '/');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$client->request('GET', '/recap');

		$this->assertEquals(302, $client->getResponse()->getStatusCode());
	}
}