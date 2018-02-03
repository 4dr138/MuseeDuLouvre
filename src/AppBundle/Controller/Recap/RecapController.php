<?php

namespace AppBundle\Controller\Recap;


use AppBundle\Entity\Basket;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RecapController extends Controller
{
    /**
     * @Route("/recap/{id}", name="recap")
     * @Method("GET")
     */
    public function recapAction(Basket $basket)
    {
        return $this->render('recap/recap.html.twig', array('basket' => $basket));
    }
}
