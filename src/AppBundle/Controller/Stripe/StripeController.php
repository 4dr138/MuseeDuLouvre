<?php

namespace AppBundle\Controller\Stripe;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StripeController extends Controller
{
    /**
     * @Route(
     *     "/checkout",
     *     name="order_checkout",
     *     methods="POST"
     * )
     */
    public function checkoutAction(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_x5faSSCFcNPsJ2yiXjzjpuwo");

        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        $amount = $_POST['valeurPaiement'];
        $amount = $amount * 100;


        // Create a charge: this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - OpenClassrooms Exemple"
            ));
            $this->addFlash("success","Votre paiement a bien été enregistré, vous allez être redirigés vers la page d'accueil !");
            return $this->redirectToRoute("homepage");
        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("error","Votre paiement n'est pas passé, veuillez ré-essayer");
//            return $this->redirectToRoute("paiement");
            // The card has been declined
        }
    }
}
