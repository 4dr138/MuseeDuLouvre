<?php

namespace AppBundle\Controller\Recap;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RecapController extends Controller
{
    /**
     * @Route("/recap/{id}", name="recap")
     *
     */
    public function recapAction($id)
    {
        $arrBillet = $this->container->get('appbundle.billetbyid');
        $billets = $arrBillet->getBilletById($id);
        $basket = $arrBillet->getBasketById($id);
        return $this->render('recap/recap.html.twig', array('billets' => $billets, 'basket' => $basket));
    }
}
