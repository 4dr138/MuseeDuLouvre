<?php

namespace AppBundle\Service;

use AppBundle\Entity\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RandomString extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Génère la chaine aléatoire
     * @return string
     *
     */
    public function generateRandomString(Basket $newbasket)
    {
        // On génère ensuite notre chaine aléatoire
        $characts    = 'abcdefghijklmnopqrstuvwxyz';
        $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts   .= '1234567890';
        $code_aleatoire      = '';

        for($i=0;$i < 10;$i++)    //10 est le nombre de caractères
        {
            $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
        }

        $newbasket->setRandomString($code_aleatoire);

        return $code_aleatoire;
    }
}



