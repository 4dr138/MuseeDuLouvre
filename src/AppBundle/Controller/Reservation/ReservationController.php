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
    public function newBasket()
    {
       $newBasket = new Basket();

       $formbuilder = $this->get('form.factory')->createBuilder(FormType::class, $newBasket);

       $formbuilder
        ->add('date', DateType::class, array(
          'label' => 'Date de réservation : ',
          'widget' => 'single_text',
          'html5' => false,
          'format' => 'dd/MM/yyyy',
          'attr' => ['class' => 'js-datepicker']))
        ->add('mail', TextType::class, array('label' => 'Veuillez entrer votre mail : '))
        ->add('type', ChoiceType::class, array(
          'label' => 'Type de billet : ',
          'choices' => array(
            'Journée' => null,
            'Demi-journée ' => null,
          ),
        ))
        ->add('nbbillets', ChoiceType::class, array(
          'label' => "Nombre de billets : ",
          'choices' => array(
            '1' => null,
            '2' => null,
            '3' => null,
            '4' => null,
            '5' => null,
            ),
        ));

       $form = $formbuilder->getForm();

       return $this->render('reservation/reservation.html.twig', array('form' => $form->createView()));
    }
}
