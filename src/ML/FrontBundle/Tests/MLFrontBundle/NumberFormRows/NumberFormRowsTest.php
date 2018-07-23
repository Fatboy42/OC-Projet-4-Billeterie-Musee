<?php 

namespace Tests\MLFrontBundle\Form;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class NumberFormRowsTest extends WebTestCase
{
	public function testNumberFormRows()
	{

		$client = static::createClient();

		$crawler = $client->request('GET', '/');

		$this->assertEquals(7, $crawler->filter('div.form-group')->count());

	}
	
}