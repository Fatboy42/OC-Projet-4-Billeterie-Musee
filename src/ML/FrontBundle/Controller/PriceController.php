<?php

namespace ML\FrontBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PriceController extends Controller
{
  /**
  *@param Request
  *Return the types and prices of the formulas in the DB
  */

  public function priceAction(Request $request)
  {
     $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('MLFrontBundle:ReservationType')
                        ->findAll();



    return $this->render('MLFrontBundle:Reservation:prices.html.twig', array(
      'formulas' => $repository,
    ));
  }
}

 ?>
