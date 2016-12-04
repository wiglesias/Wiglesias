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
        $allPortafolios = $this->getDoctrine()->getRepository('AppBundle:Portafolio')->findAllEnabledSortedByDate();

        return $this->render(':Frontend/Portafolio:portafolio.html.twig', [
            'allPortafolios' => $allPortafolios,
        ]);
    }

    /**
     * @Route("/portafolio/{slug}", name="front_portafolio_detail")
     *
     * @param string $slug
     *
     * @return Response
     */
    public function detailAction($slug)
    {
        $portafolio = $this->getDoctrine()->getRepository('AppBundle:Portafolio')->findAll(
            array(
                'slug' => $slug,
            )
        );

        return $this->render(':Frontend/Portafolio:detail.html.twig', array(
            'portafolio' => $portafolio,
        ));
    }
}
