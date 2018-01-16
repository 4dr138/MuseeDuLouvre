<?php

namespace AppBundle\Controller\Index;


use AppBundle\Entity\Billet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\Request;


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
  public function indexAction(Request $request)
  {
    $newBasket = new Basket();
    $formBasket = $this->createForm("AppBundle\Form\Type\BasketType", $newBasket);

        $formBasket->handleRequest($request);

        if ($formBasket->isSubmitted() && $formBasket->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($newBasket->getBillet() as $billet) {
                // Service calcul de prix puis retourner prix et créer attribut prix
                dump($newBasket->getId());
                dump($billet);
            }

            $em->persist($newBasket);
            $em->flush();
            return $this->redirectToRoute('recap');
        }

    return $this->render('index/index.html.twig', array('formBasket' => $formBasket->createView()));
  }

}
