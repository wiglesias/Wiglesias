<?php

namespace AppBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseAdminController
 *
 * @category Controller
 * @package AppBundle\Controller\Admin
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
abstract class BaseAdminController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Request
     */
    protected function resolveRequest(Request $request)
    {
        if (null === $request){
            return $this->getRequest();
        }

        return $request;
    }
}
