<?php

namespace ML\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ML\FrontBundle\Service\TicketsPrice;
//use Symfony\Component\Form\Extension\Core\Type\FormType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use ML\FrontBundle\Form\TicketsType;
use ML\FrontBundle\Form\ReservationType;
use ML\FrontBundle\DateManager\MLDateManager;




class ModifController extends Controller
{
    /**
    *@param Request
    *Display a pré-fill form with the session if the request is not POST
    *If the request is POST, the reservation in the session is remplaced by the modified one, and redirect to the recap page.
    *At multiple times we check if the number of selected tickets + sale tickets number =< 1000.
    */

    public function modifAction(Request $request, TicketsPrice $ticketsPrice, MLDateManager $service)
    {
        $session = $request->getSession()->get('reservation');

        if ($session)
        {
          $em = $this->getDoctrine()->getManager();
          $em->persist($session);

           $formbuilder = $this->get('form.factory')->createBuilder(ReservationType::class, $session);

           $form = $formbuilder->getForm();

           if ($request->isMethod('POST'))
           {
             $form->handleRequest($request);

             if ($form->isValid())
             {  //service
               //$service = $this->get('ml_frontbundle.datemanager');
               $var = $service->dateManager($session->getDateform());

               //$em = $this->getDoctrine()->getManager();
               //$em->persist($session);

               $session->setDate($var);

               //$session->ticketsPrice();

               $goodmodif = $ticketsPrice->ticketsPrice($session);

               //$session->makeRelation();

               //$em->detach($session);

               $request->getSession()->set('reservation', $goodmodif);

               return $this->redirectToRoute('ml_front_recap');

             }
           }


           return $this->render('MLFrontBundle:Reservation:addform.html.twig', array(
             'form' => $form->createView(),
           ));
        }
        else
        {
          return $this->redirectToRoute('ml_front_homepage');
        }
    }


}






