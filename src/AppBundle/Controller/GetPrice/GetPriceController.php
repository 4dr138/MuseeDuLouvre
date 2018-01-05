<?php

namespace AppBundle\Controller\GetPrice;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\Request;

class GetPriceController extends Controller
{
  /**
   * @Route("/modification", name="price")
   */
   public function getPriceAction($tarif)
   {
      $tarif = "Hello";
      return $tarif;
   }
}
