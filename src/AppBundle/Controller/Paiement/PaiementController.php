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
    public function paiementAction()
    {
        if($_POST['datapaiement']){
            $data = $_POST['datapaiement'];
            header("paiement");
        }
        return new Response(json_encode($data));
    }
}