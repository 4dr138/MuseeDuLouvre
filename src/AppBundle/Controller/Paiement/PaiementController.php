<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 17/01/2018
 * Time: 18:40
 */

namespace AppBundle\Controller\Paiement;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PaiementController extends Controller
{
    /**
     * @Route("/paiement", name="paiement")
     *
     * @param int $tarifTTC
     * @param string $mail
     */
    public function paiementAction($tarifTTC, $mail)
    {
        dump($tarifTTC);
        dump($mail);exit;
    }
}