<?php

namespace AppBundle\Controller\GetPrice;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Price;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class GetPriceController extends Controller
{
  /**
   * @Route("/modification/{tarif}", name="price", options={"expose"=true})
   */
   public function getPriceAction($tarif)
   {
      $queryBuilder = $this->_em->createQueryBuilder()
        ->select($tarif)
        ->from($this->Price)
        ;
        
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        return $results;
   }
}
