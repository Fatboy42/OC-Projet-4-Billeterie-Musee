<?php

namespace ML\FrontBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class PriceController extends Controller
{

  private $filelocator;

  public function __construct(FileLocator $fileLoc)
  {
      $this->filelocator = $fileLoc;
  }

  /**
  *@param Request
  *Return the types and prices of the formulas in the DB
  */

  public function priceAction(Request $request)
  {

    $dir = $this->filelocator->locate('@MLFrontBundle');
    $formules = Yaml::parse(file_get_contents($dir.'Resources/config/formules.yml'));
    $formules = $formules['formules'];

     /*$repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('MLFrontBundle:ReservationType')
                        ->findAll();*/



    return $this->render('MLFrontBundle:Reservation:prices.html.twig', array(
      'formulas' => $formules,
    ));
  }
}


