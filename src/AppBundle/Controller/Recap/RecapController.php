<?php

namespace AppBundle\Controller\Recap;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RecapController extends Controller
{
    /**
     * @Route("/recap", name="recap")
     *
     */
    public function recapAction()
    {
        return $this->render('recap/recap.html.twig');
    }
}
