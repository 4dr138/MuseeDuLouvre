<?php

namespace AppBundle\Service;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MailConfig extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Envoi le mail de confirmation
     *
     */
    public function sendMail($totalTTC, $name, $code_aleatoire, $date, $mail)
    {
        // On commence par configurer l'envoi de mail de confirmation
        $message = (new \Swift_Message('Recapitulatif de commande'))
            ->setFrom('agautier38@gmail.com')
            ->setTo($mail)
            ->setBody(
                $this->renderView('email/email.html.twig', array('totalTTC' => $totalTTC, 'name' => $name, 'code' => $code_aleatoire, 'date' => $date)),
                'text/html'
            );
        // On utilise SwiftMailer pour envoyer le mail
        $this->get('mailer')->send($message);
    }
}



