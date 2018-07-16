<?php

namespace ML\FrontBundle\DateManager;

use Doctrine\ORM\EntityManagerInterface;

use ML\FrontBundle\Entity\Dates;


class MLDateManager
{
   private $em;

   public function __construct(EntityManagerInterface $em)
   {
     $this->em = $em;
   }

   /**
   *@param Datetime
   *@return Datetime
   *Return the date if it exist, if not it create it and then return it
   */

   public function dateManager($date)
   {
     $var = $this->em
        ->getRepository('MLFrontBundle:Dates')
        ->findOneByDate($date);

      if ($var === null)
      {
         $dateentity = new Dates();
         $dateentity->setDate($date);

         $this->em->persist($dateentity);
         $this->em->flush();

         return $dateentity;
      }
      elseif ($var)
      {
        return $var;
      }

   }

}





 ?>
