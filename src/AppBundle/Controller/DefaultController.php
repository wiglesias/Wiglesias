<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render(':Frontend:homepage.html.twig', array());
    }

    /**
     * @Route("/contacto", name="front_contact")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function contactAction(Request $request)
    {
        return $this->render(':Frontend:contact.html.twig', array());
    }

    /**
     * @Route("/sobre-mi", name="front_about")
     *
     * @return Response
     */
    public function aboutAction()
    {
        return $this->render(':Frontend:about_me.html.twig', array());
    }
}
