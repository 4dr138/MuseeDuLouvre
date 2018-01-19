<?php

namespace AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PriceBillet extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Vérifie le prix du billet
     *
     * @param \DateTime $birthdate
     * @param boolean $discount
     * @return int
     */
    public function getPriceBillet($birthdate, $discount)
    {
        $today = date("Y-m-d H:i:s");
        $today = new \DateTime($today);
        $age = date_diff($birthdate, $today);
        $age = $age->y;

        if ($discount == true) {
            $tarif = "reduit";
        }
        else if ($age >= 4 && $age < 12) {
            $tarif = "enfant";
        }
        else if ($age >= 60) {
            $tarif = "senior";
        }
        else if ($age < 4) {
            $tarif = "bebe";
        }
        else {
            $tarif = "normal";
        }

        $em = $this->getDoctrine()->getManager();
        $prixBillet = $em->getRepository('AppBundle:Price')->getPrice($tarif);
        foreach($prixBillet[0] as $values){
            $prixBillet = $values;
        }
        return $prixBillet;
    }

}




