<?php

namespace AppBundle\Service;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class PaiementStripe extends Controller
{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Gère le paiement par Stripe
     *
     *
     */
    public function payByStripe(Request $request, $totalTTC)
    {
        \Stripe\Stripe::setApiKey("sk_test_x5faSSCFcNPsJ2yiXjzjpuwo");

        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        $amount = $totalTTC * 100;


        // Create a charge: this will charge the user's card
        try {
            \Stripe\Charge::create(array(
                "amount" => $amount, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe"
            ));
            return "Ok";
        } catch(\Stripe\Error\Card $e) {
            return "NotOk";
            // The card has been declined
        }
    }
}



