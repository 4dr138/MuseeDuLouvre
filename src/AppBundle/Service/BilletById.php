<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 17/01/2018
 * Time: 10:33
 */
namespace AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BilletById extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Récupère les billets et le panier selon l'id
     *
     * @param int $id
     * @return array
     */
    public function getBilletById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $billets = $em->getRepository('AppBundle:Billet')->getBillets($id);
        return $billets;
    }

    public function getBasketById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $basket = $em->getRepository('AppBundle:Basket')->getBasket($id);
        return $basket;
    }

}




