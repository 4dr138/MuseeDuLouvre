<?php

namespace AppBundle\Controller\Index;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends Controller
{
  /**
   * @Route("/", name="homepage")
   */
  public function indexAction(Request $request)
  {
    $newBasket = new Basket();
    $formBasket = $this->createForm("AppBundle\Form\Type\BasketType", $newBasket);

    if($request->isMethod('POST')) {
        $formBasket->handleRequest($request);

        if ($formBasket->isSubmitted() && $formBasket->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newBasket);
            $em->flush();

            return $this->render('paiement/paiement.html.twig');
        }
    }

    return $this->render('index/index.html.twig', array('formBasket' => $formBasket->createView()));



  }
}
