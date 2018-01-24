<?php

namespace AppBundle\Service;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class InsertExtendsPrices extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Insère les TVA et HT
     *
     */
    public function insertHTTVA(Billet $billet, Basket $newBasket, $prixBillet)
    {
        // On calcule le total des prix des billets dans la boucle pour les attribuer au total du panier
        $totalTTC = $newBasket->getTotalTTC() + $prixBillet;
        $newBasket->setTotalTTC($totalTTC);
        $totalHT = $newBasket->getTotalTTC() - ($newBasket->getTotalTTC() * 0.2);
        $totalHT = number_format($totalHT, 1);
        $newBasket->setTotalPrice($totalHT);
        $totalTVA = $newBasket->getTotalTTC() - $newBasket->getTotalPrice();
        $totalTVA = number_format($totalTVA, 1);
        $newBasket->setTotalTVA($totalTVA);
    }
}



