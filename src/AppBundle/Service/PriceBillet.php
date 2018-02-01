<?php

namespace AppBundle\Service;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
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
     * @return int
     */
    public function getPriceBillet(Billet $billet, Basket $newBasket)
    {

        $birthdate = $billet->getBirthdate();
        $discount = $billet->getDiscount();
        $today = date("Y-m-d H:i:s");
        $today = new \DateTime($today);
        $age = date_diff($birthdate, $today);
        $age = $age->y;


        if ($discount === true && $age < 4) {
            $tarif = "bebe";
        }
        else if ($discount === true && $age >= 4 && $age < 12)
        {
            $tarif = "enfant";
        }
        else if ($discount === true && $age > 12) {
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

        // On insère directement nos valeurs HT et TVA via le repository en DQL
        $HT_TVA = $this->container->get('appbundle.insertextendsprices');
        $HT_TVA->insertHTTVA($billet, $newBasket, $prixBillet);


        return $prixBillet;
    }

}




