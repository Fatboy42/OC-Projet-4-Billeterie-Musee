<?php 

namespace Tests\MLFrontBundle\Service;

use ML\Frontbundle\Service\TicketsPrice;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ML\FrontBundle\Entity\Reservation;
use ML\FrontBundle\Entity\Tickets;


class TicketsPriceTest extends WebTestCase
{
	public function testTicketsPrice()
	{
		$client = static::createClient();
		$price = $client->getContainer()->get('ML\FrontBundle\Service\TicketsPrice');

		$reservation = new Reservation();

		$ticket = new Tickets();

		$date = new \DateTime();
		$date->setDate(1997, 12, 05);

		$ticket->setBirthdate($date);

		
		$reservation->setReservationtype('journee_pleine');
		$reservation->addTicket($ticket);

		$result = $price->ticketsPrice($reservation);

		foreach ($result->getTickets() as $key) 
		{
			$this->assertEquals(20, $key->getAge());
			$this->assertEquals(16, $key->getPrice());
		}
	}
}