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
use AppBundle\Entity\Billet;



class ReservationController extends Controller
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function newBasket(Request $request)
    {
// Génération du premier formulaire qui contient les informations de la commande
       $newBasket = new Basket();

       $formbuilderBasket = $this->get('form.factory')->createBuilder(FormType::class, $newBasket);

       $formbuilderBasket
        ->add('date', DateType::class, array(
          'label' => 'Date de réservation : ',
          'widget' => 'single_text',
          'html5' => false,
          'format' => 'dd/MM/yyyy',
          "required" => true,
          'attr' => ['class' => 'js-datepicker']))
        ->add('mail', TextType::class, array(
          'label' => 'Veuillez entrer votre mail : ',
          "required" => true))
        ->add('type', ChoiceType::class, array(
          'label' => 'Type de billet : ',
          'choices' => array(
            'Journée' => 'Journée',
            'Demi-journée ' => 'Demi-journée',
          ),
        ))
        ->add('nbbillets', ChoiceType::class, array(
          'label' => "Nombre de billets : ",
          'choices' => array(
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            ),
        ))
        ->add('Ok', SubmitType::class, array(
          'label' => 'Valider les informations générales',
          'attr' => ['class' => 'validFormBasket']
      ));

      $formBasket = $formbuilderBasket->getForm();

      if ($request->isMethod('POST')) {

        $formBasket->handleRequest($request);

        if ($formBasket->isValid()) {

          $session = $request->getSession();

          $em = $this->getDoctrine()->getManager();
          $em->persist($newBasket);
          $em->flush();

          $session->getFlashBag()->add('infos', 'Informations générales enregistrées.');

          return $this->redirectToRoute('reservation', array('id' => $newBasket->getId()));
        }
      }
      return $this->render('reservation/reservation.html.twig', array('formBasket' => $formBasket->createView()));
}

    /**
     * @Route("/resaBillet", name="resaBillet")
     */
    // public function newBillet()
    // {
//
// // Création du second formulaire qui contient les informations relatives au(x) billet(s) unique(s)
//         $newBillet = new Billet();
//
//         $formbuilderBillet = $this->get('form.factory')->createBuilder(FormType::class, $newBillet);
//
//         $formbuilderBillet
//           ->add('name', TextType::class, array('label' => 'Nom : ',"required" => true,))
//           ->add('firstname', TextType::class, array('label' => 'Prénom : ',"required" => true,))
//           ->add('birthdate', DateType::class, array(
//             'label' => 'Date de naissance : ',
//             'widget' => 'choice',
//             'html5' => false,
//             'years' => range(1920,2018)))
//           ->add('country', ChoiceType::class, array(
//             'label' => 'Pays de résidence : ',
//             "choices" => array(
//               'France' => null,
//               'Angleterre' => null
//             )
//           ))
//           ->add('discount', CheckboxType::class, array(
//             'label' => 'Tarif réduit ? ',
//             'required' => true
//           ))
//           ->add('Save', SubmitType::class, array(
//             'label' => 'Ajouter un billet',
//             'attr' => ['class' => 'validFormBillet']
//           ));
//
//
// // Génération des deux formulaires
//        $formBasket = $formbuilderBasket->getForm();
//        $formBillet = $formbuilderBillet->getForm();
//
//        return $this->render('reservation/reservation.html.twig', array('formBasket' => $formBasket->createView(), 'formBillet' => $formBillet->createView()));
//     }
  // }
}
