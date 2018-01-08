<?php

namespace AppBundle\Controller\Paiement;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PaiementController extends Controller
{
    /**
     * @Route("/paiement", name="paiement", options={"expose"=true})
     */
    public function paiementAction($datapaiement)
    {
        var_dump($_POST[$datapaiement]);
    }
}
