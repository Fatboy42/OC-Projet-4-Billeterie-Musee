<?php 

namespace Tests\MLFrontBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ML\FrontBundle\Entity\Dates;


class CheckQuantityTest extends WebTestCase
{

	public function testCheckQuantity()
	{
		$client = static::createClient();

		$dateservice = $client->getContainer()->get('ML\FrontBundle\CheckQuantity\MLCheckQuantity');

		$datetime = new \Datetime();

		$datetime->setDate(2018, 07, 23);

		$soldQuantity = $dateservice->quantityChecker($datetime);

		$this->assertEquals(6, $soldQuantity->getSoldQuantity());

		$datetimee = $datetime->setDate(2018, 07, 22);

		$soldQuantity = $dateservice->quantityChecker($datetimee);

		$this->assertEquals(false, $soldQuantity);

	}
}
