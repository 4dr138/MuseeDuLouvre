<?php

namespace AppBundle\Service;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UpdateStatus extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Met à jour le statut du billet
     * @var $id
     *
     */
    public function setStatus($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Basket')->setStatusBasket($id);
    }

}




