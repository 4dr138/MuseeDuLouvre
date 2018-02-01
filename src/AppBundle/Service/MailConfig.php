<?php

namespace AppBundle\Service;

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
    public function sendMail($totalTTC, $name, $code_aleatoire, $date, $mail, $firstname)
    {
        // On commence par configurer l'envoi de mail de confirmation
        $message = (new \Swift_Message('Recapitulatif de commande'))
            ->setFrom('contact@billetteriemuseedulouvre.fr')
            ->setTo($mail)
            ->setBody(
                $this->renderView('email/email.html.twig', array('totalTTC' => $totalTTC, 'name' => $name, 'code' => $code_aleatoire, 'dateresa' => $date, 'firstname' => $firstname)),
                'text/html'
            );
        // On utilise SwiftMailer pour envoyer le mail
        $this->get('mailer')->send($message);
    }
}



