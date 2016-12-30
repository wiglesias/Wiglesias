<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
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
        $allPortafolios = $this->getDoctrine()->getRepository('AppBundle:Portafolio')->findAllEnabledSortedByDate();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($allPortafolios, $pagina, 9);

        return $this->render(':Frontend/Portafolio:portafolio.html.twig', [
            'pagination' => $pagination,
            'allPortafolios' => $allPortafolios,
        ]);
    }

//    /**
//     * @Route("/portafolio/{year}/{month}/{day}/{slug}", name="front_portafolio_detail")
//     *
//     * @param $year
//     * @param $month
//     * @param $day
//     * @param string $slug
//     *
//     * @return Response
//     * @throws EntityNotFoundException
//     */
//    public function detailAction($year, $month, $day, $slug)
//    {
//        $date = \DateTime::createFromFormat('Y-m-d', $year . '-' . $month - '-' . $day);
//
//        $portafolio = $this->getDoctrine()->getRepository('AppBundle:Portafolio')->findAll(
//            array(
//                'publishedAt' => $date,
//                'slug' => $slug,
//            )
//        );
//
//        if (!$portafolio) {
//            throw new EntityNotFoundException();
//        }
//
//        return $this->render(':Frontend/Portafolio:detail.html.twig', array(
//            'portafolio' => $portafolio,
//        ));
//    }
}
