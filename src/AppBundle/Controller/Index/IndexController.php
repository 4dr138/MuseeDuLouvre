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
    $formBasket->handleRequest($request);

    return $this->render('index/index.html.twig', array('formBasket' => $formBasket->createView()));

  }
}
