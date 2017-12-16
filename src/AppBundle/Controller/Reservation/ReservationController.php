<?php

namespace AppBundle\Controller\Reservation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Basket;


class ReservationController extends Controller
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function newBillet()
    {
       $newBasket = new Basket();

       $formbuilder = $this->get('form.factory')->createBuilder(FormType::class, $newBasket);

       $formbuilder
        ->add('date', DateType::class)
        ->add('mail', TextType::class)
        ->add('type', ChoiceType::class)
        ->add('nbbillets', ChoiceType::class)
        ;

      $form = $formbuilder->getForm();

       return $this->render('reservation/reservation.html.twig', array('form' => $form->createView()));
    }
}
