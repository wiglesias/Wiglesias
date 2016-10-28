<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="front_blog")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render(':FrontEnd/Blog:list.html.twig');
    }
}