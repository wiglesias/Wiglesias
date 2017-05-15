<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Invoice;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class InvoiceAdminController
 *
 * @category Controller
 * @package AppBundle\Controller\Admin
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoiceAdminController extends Controller
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
    public function pdfAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Invoice $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->addFlash(
            'success',
            'Tu factura número '.$object->getId()
        );

        return $this->redirectToRoute('admin_app_invoice_list');
    }

    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }
}
