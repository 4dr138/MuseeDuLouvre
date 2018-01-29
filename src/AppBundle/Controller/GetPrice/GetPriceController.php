<?php
namespace AppBundle\Controller\GetPrice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class GetPriceController extends Controller
{
    /**
     * @Route("/modification/{tarif}", name="price", options={"expose"=true})
     */
    public function getPriceAction($tarif)
    {
        $em = $this->getDoctrine()->getManager();
        $price = $em->getRepository('AppBundle:Price')->getPrice($tarif);
        foreach($price[0] as $values){
            $price = $values;
        }
        return new Response($price);
    }
}