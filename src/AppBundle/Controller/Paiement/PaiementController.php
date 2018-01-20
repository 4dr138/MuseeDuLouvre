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
     * @Route("/paiement/{totalTTC}/{mail}/{id}/{date}", name="paiement")
     *
     */
    public function paiementAction($totalTTC, $mail, $id, $date, Request $request)
    {

        // On récupère les différents noms en fonction de l'id
        $name = $this->container->get('appbundle.billetbyid');
        $name = $name->getNamesById($id);

        // On génère ensuite notre chaine aléatoire
        $characts    = 'abcdefghijklmnopqrstuvwxyz';
        $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts   .= '1234567890';
        $code_aleatoire      = '';

        for($i=0;$i < 10;$i++)    //10 est le nombre de caractères
        {
            $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
        }

        // On commence par configurer l'envoi de mail de confirmation
        $message = (new \Swift_Message('Recapitulatif de commande'))
            ->setFrom('agautier38@gmail.com')
            ->setTo($mail)
            ->setBody(
                $this->renderView('email/email.html', array('totalTTC' => $totalTTC, 'name' => $name, 'code' => $code_aleatoire, 'date' => $date)),
                'text/html'
            );
        // On utilise SwiftMailer pour envoyer le mail
        $this->get('mailer')->send($message);

        return $this->render('confirmationPaiement/confirmationPaiement.html.twig', array('totalTTC' => $totalTTC));

    }
}