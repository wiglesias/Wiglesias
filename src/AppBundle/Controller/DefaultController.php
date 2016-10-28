<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="front_homepage")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->render(':FrontEnd:homepage.html.twig', array());
    }

    /**
     * @Route("/blog", name="front_log")
     *
     * @return Response
     */
    public function blogAction()
    {
        return $this->render(':FrontEnd/Blog:list.html.twig', array());
    }
}
