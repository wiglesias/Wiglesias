<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactMessage;
use AppBundle\Form\Type\ContactHomepageType;
use AppBundle\Form\Type\ContactMessageType;
use AppBundle\Service\NotificationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $form = $this->createForm(ContactHomepageType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var NotificationService $messenger */
            $messenger = $this->get('app.notification');
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
            $messenger->sendCommonUserNotification($contact);
            $messenger->sendCommonAdminNotification($contact);
            // Clean up new form
            $form = $this->createForm(ContactHomepageType::class);
        }

        return $this->render(':Frontend:homepage.html.twig', array(
            'formHomepage' => $form->createView(),
        ));
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
            /** @var NotificationService $messenger */
            $messenger = $this->get('app.notification');
            $messenger->sendCommonUserNotification($contactMessage);
            $messenger->sendContactAdminNotification($contactMessage);
            // Clean up new form
            $contactMessage = new ContactMessage();
            $form = $this->createForm(ContactMessageType::class, $contactMessage);
        }

        return $this->render(':Frontend:contact.html.twig', array(
            'formContact' => $form->createView(),
        ));
    }
}
