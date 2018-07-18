<?php

namespace ML\FrontBundle\Controller;

use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ML\FrontBundle\Service\TicketsPrice;
//use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\FormType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;
//use ML\FrontBundle\Form\TicketsType;
use ML\FrontBundle\Form\ReservationType;
use ML\FrontBundle\DateManager\MLDateManager;





class ReservationController extends Controller
{
  /**
  *@param Request
  *If the request is not POST, a empty form is displayed.
  *If the request is POST, the form is stored into the session (after being validated).
  *Redirect to the recap page.
  */

  public function addReservationAction(Request $request, TicketsPrice $ticketsPrice, MLDateManager $service)
  {
    /*$dir = $this->get('kernel')->locateResource('@MLFrontBundle');
    $formules = Yaml::parse(file_get_contents($dir.'Resources/config/formules.yml'));
    $price = $formules['formules']['journee_pleine']['kid'];
    dump($price);*/

    $resa = new Reservation();

    $formbuilder = $this->get('form.factory')->createBuilder(ReservationType::class, $resa);  //createbuilder

    $form = $formbuilder->getForm();

    if ($request->isMethod('POST'))
    {
       $form->handleRequest($request);

       if ($form->isValid())
       {
         //$service = $this->get('ml_frontbundle.datemanager');
         $var = $service->dateManager($resa->getDateform());

         //$em = $this->getDoctrine()->getManager();


         $resa->setDate($var);

         //$resa->ticketsPrice();

         $goodresa = $ticketsPrice->ticketsPrice($resa);// directement $resa ? dump $resa et $goodresa
         //$em->persist($goodresa);
         //$resa->makeRelation();

         //$em->detach($resa);

         $request->getSession()->set('reservation', $goodresa);

         return $this->redirectToRoute('ml_front_recap');

         //$varr = $request->getSession()->get('reservation');


         //var_dump($varr);
         //var_dump($varr->getTickets());

       }
    }

    return $this->render('MLFrontBundle:Reservation:addform.html.twig', array(
      'form' => $form->createView(),
    ));
  }



}



 ?>
