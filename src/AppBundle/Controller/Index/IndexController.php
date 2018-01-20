<?php

namespace AppBundle\Controller\Index;


use AppBundle\Entity\Billet;
use AppBundle\Entity\Price;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\PriceBillet;


class IndexController extends Controller
{

  /**
   * @Route("/", name="homepage")
   * @Method({"GET","POST"})
   */
  public function indexAction(Request $request)
  {
      $newBasket = new Basket();
      $formBasket = $this->createForm("AppBundle\Form\Type\BasketType", $newBasket);

      $formBasket->handleRequest($request);

      if ($formBasket->isSubmitted() && $formBasket->isValid()) {
          $em = $this->getDoctrine()->getManager();

          // On gère le conditionnemment des 1000 billets max pour la journée
          $dateresa = $newBasket->getDate();
          $totalBilletByDate = $this->container->get('appbundle.billetsbydate');
          $totalBilletByDate = $totalBilletByDate->getBilletsByDate($dateresa);
                if ($totalBilletByDate <= 1000) {
                    // On boucle sur chacun des billets saisis
                    foreach ($newBasket->getBillet() as $billet) {
                        $billet->setBasket($newBasket);
                        // On utilise le service pour récupérer le prix unitaire
                        $priceBillet = $this->container->get('appbundle.pricebillet');
                        $birthdate = $billet->getBirthdate();
                        $discount = $billet->getDiscount();
                        $priceBillet = $priceBillet->getPriceBillet($birthdate, $discount);
                        // On attribue ce prix au billet
                        $billet->setPrice($priceBillet);
                        // On calcule le total des prix des billets dans la boucle pour les attribuer au total du panier
                        $totalPrice = $billet->getPrice() + $newBasket->getTotalPrice();
                        $newBasket->setTotalPrice($totalPrice);
                        $totalTVA = $newBasket->getTotalPrice() * 0.2;
                        $totalTVA = number_format($totalTVA, 1);
                        $newBasket->setTotalTVA($totalTVA);
                        $totalTTC = $newBasket->getTotalPrice() + $newBasket->getTotalTVA();
                        $totalTTC = number_format($totalTTC, 1);
                        $newBasket->setTotalTTC($totalTTC);
                    }

                    $em->persist($newBasket);
                    $em->flush();
                    return $this->redirectToRoute('recap', array('id' => $newBasket->getId()));
                } else {
                    $this->addFlash("error", "Désolé mais le maximum des places a été atteint. Il reste seulement" + (1000 - $totalBilletByDate) + "pour ce jour");
                    return $this->redirectToRoute('homepage');
                }
  }
                 return $this->render('index/index.html.twig', array('formBasket' => $formBasket->createView()));
  }
}

// calcul tva nveau champ