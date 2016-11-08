<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PortafolioController extends Controller
{
    /**
     * @Route("/portafolio", name="front_portafolio")
     *
     * @return  Response
     */
    public function listAction()
    {
        $portafolios = $this->getDoctrine()->getRepository('AppBundle:Portafolio')->findAll();

        return $this->render(':Frontend:portafolio.html.twig', [
            'portafolios' => $portafolios
        ]);
    }
}
