<?php
/**
 * Created by PhpStorm.
 * User: agaut
 * Date: 17/01/2018
 * Time: 18:40
 */

namespace AppBundle\Controller\Paiement;

use AppBundle\Entity\Basket;
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
        $stripe = $this->container->get('appbundle.paiementstripe')->payByStripe($request, $totalTTC);
        if($stripe == "Ok") {
            // On récupère les différents noms en fonction de l'id
            $billet = $this->container->get('appbundle.billetbyid')->getBilletById($id);
            // on récupère le code aléatoire
            $code = $this->container->get('appbundle.billetbyid')->getBasketById($id);
            for($i = 0; $i < count($code); ++$i) {
                $code_aleatoire = $code[$i]["randomstring"];
            }
            // On met à jour le statut par un service
            $this->container->get('appbundle.updatestatus')->setStatus($id);

            // On gère la configuration de l'envoi du mail récap
            $this->container->get("appbundle.mailconfig")->sendMail($totalTTC, $code_aleatoire, $date, $mail, $billet);

            $this->addFlash("success", "Votre paiement a bien été enregistré, vous devriez recevoir un mail de confirmation");
            return $this->redirectToRoute('homepage');
        }
        else
        {
            $this->addFlash("error", "Votre paiement n'est pas passé, veuillez ré-essayer !");
            return $this->redirectToRoute('recap', array('id' => $id, 'message' => $this));
        }

    }
}