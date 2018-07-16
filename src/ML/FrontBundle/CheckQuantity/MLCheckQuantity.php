<?php

namespace ML\FrontBundle\CheckQuantity;

use Doctrine\ORM\EntityManagerInterface;

use ML\FrontBundle\Entity\Dates;


class MLCheckQuantity
{
   private $em;

   public function __construct(EntityManagerInterface $em)
   {
     $this->em = $em;
   }

   /**
   *@param DateTime
   *@return Datetime
   *@return boolean
   *Check if a date exist, if yes it return it, if not it return false
   *
   */

   public function quantityChecker($date)
   {
     $var = $this->em
        ->getRepository('MLFrontBundle:Dates')
        ->findOneByDate($date);

    //var_dump($var);

    if ($var === null)
    {
      return false;
    }
    else {
      return $var;
    }


   }

}





 ?>
