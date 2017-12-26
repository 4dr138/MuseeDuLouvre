<?php

namespace AppBundle\Controller\Index;


use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use AppBundle\Form\Type\BasketType;
use AppBundle\Form\Type\BilletType;

class IndexController extends Controller
{

  /**
   * @Route("/", name="homepage")
   */
  public function indexAction()
  {
    $newBasket = new Basket();
    $formBuilderBasket = $this->get('form.factory')->createBuilder(BasketType::class, $newBasket);
    $newBillet = new Billet();
    $formBuilderBillet = $this->get('form.factory')->createBuilder(BilletType::class, $newBillet);

    $formBasket = $formBuilderBasket->getForm();
    $formBillet = $formBuilderBillet->getForm();

    return $this->render('index/index.html.twig', array('formBasket' => $formBasket->createView(), 'formBillet' => $formBillet->createView()));
  }

  /**
   * @Route("/reservation", name="reservation")
   * @Method({"GET","POST"})
   */
  public function newBasket(Request $request)
  {
// Génération du premier formulaire qui contient les informations de la commande
     $newBasket = new Basket();

     $formbuilderBasket = $this->get('form.factory')->createBuilder(FormType::class, $newBasket);

    $formBasket = $formbuilderBasket->getForm();


      if ($formBasket->isValid() && $formBasket->isSubmitted()) {

        $em = $this->getDoctrine()->getManager();
        $em->persist($newBasket);
        $em->flush();

        $this->addFlash('infos', 'Informations générales enregistrées.');

        return $this->redirectToRoute('reservation', array('id' => $newBasket->getId()));
      }

    return $this->render('index/index.html.twig', array('formBasket' => $formBasket->createView()));
  }

}
