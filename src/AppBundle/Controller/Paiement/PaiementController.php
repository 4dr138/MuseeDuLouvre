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
use Symfony\Component\HttpFoundation\Request;


class PaiementController extends Controller
{
    /**
     * @Route("/paiement/{totalTTC}/{mail}/{id}/{date}", name="paiement", methods="POST")
     *
     */
    public function paiementAction($totalTTC, $mail, $id, $date, Request $request)
    {
        // On gère la solution de paiement via Stripe
        $stripe = $this->container->get('appbundle.paiementstripe');
        $stripe = $stripe->payByStripe($request, $totalTTC);
        if($stripe == "Ok") {
            // On récupère les différents noms en fonction de l'id
            $name = $this->container->get('appbundle.billetbyid');
            $name = $name->getNamesById($id);

            // On génère le code aléatoire
            $code_aleatoire = $this->container->get('appbundle.randomstring');
            $code_aleatoire = $code_aleatoire->generateRandomString();

            // On gère la configuration de l'envoi du mail récap
            $mailToSend = $this->container->get("appbundle.mailconfig");
            $mailToSend->sendMail($totalTTC, $name, $code_aleatoire, $date, $mail);

            return $this->redirectToRoute('homepage');
        }
        else
        {
            $this->addFlash("error", "Votre paiement n'est pas passé, veuillez ré-essayer !");
            return $this->redirectToRoute('recap', array('id' => $id, 'message' => $this));
        }

    }
}