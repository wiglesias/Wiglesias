<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Invoice;
use AppBundle\Service\InvoicePdfBuilderService;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class InvoiceAdminController.
 *
 * @category Controller
 *
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoiceAdminController extends Controller
{
    /**
     * Custom show action redirect to public frontend view.
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response
     *
     * @throws NotFoundHttpException     If the object does not exist
     * @throws AccessDeniedHttpException If access is not granted
     */
    public function pdfAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Invoice $object */
        $object = $this->admin->getObject($id);
        $setting = $this->getDoctrine()->getRepository('AppBundle:Setting')->find(1);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->addFlash(
            'success',
            'Tu factura número '.$object->getId()
        );

        $html = $this->renderView(':PDF:invoice_printer.html.twig', array(
                'invoice' => $object,
                'setting' => $setting,
            )
        );

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="factura-'.$object->getInvoiceNumber().'.pdf"',
            )
        );
    }

    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }

    /**
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     * @throws AccessDeniedException
     */
    public function sendAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Invoice $object */
        $object = $this->admin->getObject($id);
        $setting = $this->getDoctrine()->getRepository('AppBundle:Setting')->find(1);

        if (!$object || !$setting) {
            throw $this->createNotFoundException(sprintf('unable to find the invoice or the setting with id : %s', $id));
        }

        $html = $this->renderView(':PDF:invoice_printer.html.twig', array(
            'invoice' => $object,
            'setting' => $setting,
        ));

        $pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html);

        // Send
        $messenger = $this->get('app.notification');
        $messenger->sendInvoiceCustomer($object, $pdf);
        // build flash message
        $this->addFlash('success', 'La factura se ha enviado correctamente');

        return $this->redirectToRoute('admin_app_invoice_list', array(
            'invoice' => $object,
        ));
    }

    /**
     * Invoice pdf action.
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function invoiceAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Invoice $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $setting = $this->get('app.setting_repository')->getBySlug('violet-rowe');

        /** @var InvoicePdfBuilderService $saps */
        $saps = $this->get('app.invoice_pdf_builder');
        $pdf = $saps->build($object, $setting);

        return new Response($pdf->Output('invoice_'.$object->getId().'.pdf', 'I'), 200, array(
            'Content-type' => 'application/pdf',
            )
        );
    }
}
