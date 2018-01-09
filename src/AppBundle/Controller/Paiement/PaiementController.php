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

// Appeler le formulaire pour tout stocker dedans ?
// Stocker manuellement par une fonction ?
// Je gère le stockage des données ici, et je m'en ressers ensuite en appelant une autre page sur le success de la requete ajax