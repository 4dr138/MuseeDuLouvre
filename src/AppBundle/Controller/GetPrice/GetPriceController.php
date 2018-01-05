<?php

namespace AppBundle\Controller\GetPrice;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Price;

class GetPriceController extends Controller
{
  /**
   * @param $tarif
   * @return Price[]
   * @Route("/modification/{tarif}", name="price", options={"expose"=true})
   */
   public function getPriceAction($tarif)
   {
        $em = $this->getDoctrine()->getManager();
        $price = $em->getRepository('AppBundle:Price')->getPrice($tarif);

        return $price;

   }
}
