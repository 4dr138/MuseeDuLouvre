<?php

namespace AppBundle\Controller\Recap;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RecapController extends Controller
{
    /**
     * @Route("/recap", name="recap")
     */
    public function recapAction(Request $request)
    {
        return $this->render('recap/recap.html.twig');
    }
}
