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

class BilletsByDate extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Récupère le nombre total de billets réalisés dans la journée
     *
     * @param \DateTime $dateresa
     * @return int
     */
    public function getBilletsByDate($dateresa)
    {
        $em = $this->getDoctrine()->getManager();
        $billets = $em->getRepository('AppBundle:Billet')->getBilletsDate($dateresa);
        foreach($billets[0] as $values){
            $billets = $values;
        }
        return $billets;
    }
}




