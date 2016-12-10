<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Portafolio;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PortafolioAdminController
 *
 * @category Controller
 * @package AppBundle\Controller\Admin
 * @author wils Iglesias <wiglesias83@gmail.com>
 */
class PortafolioAdminController extends BaseAdminController
{
    /**
     * Custom show action redirect to public frontend view
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedHttpException If access is not granted
     */
    public function showAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Portafolio $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        return $this->redirectToRoute(
            'front_portafolio_detail',
            array(
                'slug' => $object->getSlug(),
            )
        );
    }
}
