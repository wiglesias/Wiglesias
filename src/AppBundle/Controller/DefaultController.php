<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactMessage;
use AppBundle\Form\Type\ContactMessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $contact = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set frontend flash message
            $this->addFlash(
                'notice',
                'Te contestaré lo más pronto posible. Gracias. '
            );
            // Persist new contact message into DB
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            // Send email notifications
            $messenger = $this->get('app.notification');
            $messenger->sendCommonUserNotification($contact);
            $messenger->sendCommonAdminNotification($contact);
            // Clean up new form in production environment
            if ($this->get('kernel')->getEnvironment() == 'prod') {
                $contact = new ContactMessage();
                $form = $this->createForm(ContactMessageType::class, $contact);
            }
        }

        return $this->render(':Frontend:homepage.html.twig', array(
            'formHomepage' => $form->createView(),
        ));
    }

    /**
     * @Route("/sobre-mi", name="front_about")
     */
    public function aboutAction()
    {
        return $this->render(':Frontend:about.html.twig');
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
        $contactMessage = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set frontend flash message
            $this->addFlash(
                'notice',
                'Tu mensaje se ha enviado correctamente'
            );
            // Persist new contact message into DB
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactMessage);
            $em->flush();
            // Send email notifications
            $messenger = $this->get('app.notification');
            $messenger->sendCommonUserNotification($contactMessage);
            $messenger->sendContactAdminNotification($contactMessage);
            // Clean up new form in production environment
            if ($this->get('kernel')->getEnvironment() == 'prod') {
                $contactMessage = new ContactMessage();
                $form = $this->createForm(ContactMessageType::class, $contactMessage);
            }
        }

        return $this->render(':Frontend:contact.html.twig', array(
            'formContact' => $form->createView(),
        ));
    }

    /**
     * @Route("/creditos", name="front_credits")
     *
     * @return Response
     */
    public function creditsAction()
    {
        return $this->render(':Frontend:credits.html.twig');
    }

    /**
     * @Route("/test-email", name="front_test_email")
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function testEmailAction()
    {
        if ($this->container->get('kernel')->getEnvironment() == 'prod') {
            throw new NotFoundHttpException();
        }
        $contactMessage = new ContactMessage();
        $contactMessage
            ->setName('test')
            ->setMessage('ok test')
        ;
//        $contactMessage = $this->getDoctrine()->getRepository('AppBundle:ContactMessage')->find(81);

        return $this->render(':Mails:user_backend_answer_notification.html.twig', array(
            'contact' => $contactMessage
        ));
    }

    /**
     * @Route("/test-pdf", name="front_show_pdf")
     */
    public function showPDFAction()
    {
        if ($this->container->get('kernel')->getEnvironment() == 'prod') {
            throw new NotFoundHttpException();
        }
        $setting = $this->getDoctrine()->getRepository('AppBundle:Setting')->find(1);
        $invoice = $this->getDoctrine()->getRepository('AppBundle:Invoice')->find(1);

        return $this->render(':PDF:invoice_printer.html.twig', [
            'invoice' => $invoice,
            'setting' => $setting,
        ]);
    }

    /**
     * @Route("/test-send-invoice", name="front_show_send_invoice")
     */
    public function showSendInvoiceAction()
    {
        if ($this->container->get('kernel')->getEnvironment() == 'prod') {
            throw new NotFoundHttpException();
        }

        $invoice = $this->getDoctrine()->getRepository('AppBundle:Invoice')->find(1);
        $setting = $this->getDoctrine()->getRepository('AppBundle:Setting')->find(1);

        return $this->render(':Mails:customer_backend_send_invoice.html.twig', [
            'invoice' => $invoice,
            'setting' => $setting,
        ]);
    }
}
