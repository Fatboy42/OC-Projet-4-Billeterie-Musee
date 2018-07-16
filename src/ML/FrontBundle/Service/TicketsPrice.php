<?php 

namespace ML\FrontBundle\Service;

use ML\FrontBundle\Entity\Reservation;

class TicketsPrice
{
	public function ticketsPrice(Reservation $reservation)
	{
		
       /*$prixformule = array($this->getReservationtype()->getKid(),
                            $this->getReservationtype()->getTeen(),
                            $this->getReservationtype()->getAdult(),
                            $this->getReservationtype()->getSenior()
                            ); //possibilité de mettre getreservationType dans variable

       $student = $this->getReservationType()->getStudent();
       */
      $totalpricee = 0;
      foreach ($reservation->getTickets() as $value)//$value représente une ligne du tableau, donc une instance tickets
      {
        $birthdate = $value->getBirthdate();
        /*$daydate = $birthdate->format('D');
        $monthdate = $birthdate->format('M');

        if ($daydate == 29 && $monthdate == 02)
        {
          $birthdate->modify('-1 day');
        }*/


        $rn = new \DateTime();

        $age = $rn->diff($birthdate)->y;

        $value->setAge($age);

        if ($age <= 3)
        {
          $var = $reservation->getReservationType()->getBaby();
          $value->setPrice($var);
        }

        elseif ($age >= 4 && $age <= 11)
        {
          $var = $reservation->getReservationType()->getKid();
          $value->setPrice($var);
        }

        elseif ($age >= 12 && $age <= 59)
        {
          $var = $reservation->getReservationType()->getNormal();
          $value->setPrice($var);
        }

        elseif ($age >= 60)
        {
          $var = $reservation->getReservationType()->getSenior();
          $value->setPrice($var);
        }

        if ($value->getStudent() == true)
        {
          $reduc = $value->getPrice() - $reservation->getReservationType()->getStudent();
          if ($reduc < 0) {
            $reduc = 0;
          }
          $value->setPrice($reduc);
        }
      $value->setReservation($reservation); //etablissement de la relation bidirectionnelle
      $totalpricee += $value->getPrice();

      }

      $reservation->setTotalprice($totalpricee);
      return $reservation;
    }
	
}