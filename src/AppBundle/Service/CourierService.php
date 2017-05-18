<?php

namespace AppBundle\Service;

/**
 * Class CourierService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   Wils <wiglesias83@gmail.com>
 */
class CourierService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * CourierService constructor
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send an email
     *
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param string|null $replyAddress
     *
     * @return int
     */
    public function sendEmail($from, $to, $subject, $body, $replyAddress = null)
    {
        $message = new \Swift_Message();
        $message
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setCharset('UTF-8')
            ->setContentType('text/html');
        if (!is_null($replyAddress)) {
            $message->setReplyTo($replyAddress);
        }

        return $this->mailer->send($message);
    }

    /**
     * Send an email
     *
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param string $pdf
     *
     * @return int
     */
    public function sendEmailWithAttachment($from, $to, $subject, $body, $pdf)
    {
        $attachment = \Swift_Attachment::newInstance($pdf, $subject.'.pdf', 'application/pdf');

        $message = new \Swift_Message();
        $message
            ->attach($attachment)
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setCharset('UTF-8')
            ->setContentType('text/html');

        return $this->mailer->send($message);
    }
}
