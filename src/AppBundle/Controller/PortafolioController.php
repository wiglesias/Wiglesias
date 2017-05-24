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
     * @param int $pagina
     *
     * @return Response
     */
    public function listAction($pagina = 1)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:PortfolioCategory')->getAllEnabledSortedByTitle();
        $portfolios = $this->getDoctrine()->getRepository('AppBundle:Portafolio')->findAllEnabledSortedByDate();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($portfolios, $pagina, 9);


        return $this->render(':Frontend/Portafolio:portafolio.html.twig', [
            'pagination' => $pagination,
            'categories' => $categories,
        ]);
    }
}
