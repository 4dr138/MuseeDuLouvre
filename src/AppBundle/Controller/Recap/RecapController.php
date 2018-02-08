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
    public function recapAction(Basket $basket, $id)
    {
        $status = $this->container->get('appbundle.billetbyid')->getBasketById($id);
        foreach($status[0] as $values){
            $statut = $values;
        }

        if($statut == 'Released' or $statut == 'Aborted')
        {
            return $this->render(':AlerteRedirectionRecap:alertrecap.html.twig');
        }

        return $this->render('recap/recap.html.twig', array('basket' => $basket));
    }
}
