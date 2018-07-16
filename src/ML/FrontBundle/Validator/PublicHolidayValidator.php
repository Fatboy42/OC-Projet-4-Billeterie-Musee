<?php

namespace ML\FrontBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class PublicHolidayValidator extends ConstraintValidator
{
   public function validate($value, Constraint $constraint)
   {
     if ($this->isPublicHoliday($value))
     {
       $this->context->addViolation($constraint->message);
     }
   }

   /**
   *@param DateTime
   *@return Array
   *Return the date that correspond the param via a 'in_array'
   */

   public function isPublicHoliday($datevar)
   {
     //utc ?
     $var = $datevar->getTimestamp();

     $var = strtotime(date('m/d/Y', $var));

     $year = date('Y', $var);

     $easterDate = easter_date($year);
     $easterDay = date('j', $easterDate);
     $easterMonth = date('n', $easterDate);
     $easterYear = date('Y', $easterDate);

     $publicholiday = array(
       mktime(0, 0, 0, 1, 1, $year), //Jour de l'an
       mktime(0, 0, 0, 5, 1, $year), //Fete du travail
       mktime(0, 0, 0, 5, 8, $year), //Victoire alliés
       mktime(0, 0, 0, 7, 14, $year), //Fete Nationale
       mktime(0, 0, 0, 8, 15, $year), //Assomption
       mktime(0, 0, 0, 11, 1, $year), //Toussain
       mktime(0, 0, 0, 11, 11, $year), //Armistice
       mktime(0, 0, 0, 12, 25, $year), //Noel

       //Jours feriés mouvants

       mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear), //Lundi de paques
       mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear), //Ascension
       mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear), //Pentecote
     );

     return in_array($var, $publicholiday);
   }


}






 ?>
