<?php 

namespace ML\FrontBundle\Service;

use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class TicketsPrice
{

  private $filelocator;

  public function __construct(FileLocator $fileLocator)
  {
      $this->filelocator = $fileLocator;
  }


	public function ticketsPrice(Reservation $reservation)
	{
		
      $dir = $this->filelocator->locate('@MLFrontBundle');
      $formules = Yaml::parse(file_get_contents($dir.'Resources/config/formules.yml'));
      $price = $formules['formules'][$reservation->getReservationType()];

      //var_dump($dir);

      $totalpricee = 0;
      foreach ($reservation->getTickets() as $value)//$value représente une ligne du tableau, donc une instance tickets
      {
        $birthdate = $value->getBirthdate();
        


        $rn = new \DateTime();

        $age = $rn->diff($birthdate)->y;

        $value->setAge($age);

        if ($age <= 3)
        {
          $var = $price['baby'];
          $value->setPrice($var);
        }

        elseif ($age >= 4 && $age <= 11)
        {
          $var = $price['kid'];
          $value->setPrice($var);
        }

        elseif ($age >= 12 && $age <= 59)
        {
          $var = $price['normal'];
          $value->setPrice($var);
        }

        elseif ($age >= 60)
        {
          $var = $price['senior'];
          $value->setPrice($var);
        }

        if ($value->getStudent() == true)
        {
          $reduc = $value->getPrice() - $price['student'];
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