<?php
namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;




class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig\Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {

        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Clampophilie : ' . $contact->getArticle()->getTitre()))
            ->setFrom('hello@world.fr')
            ->setTo('contact@clampophilie.fr')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]),'text/html');
        $this->mailer->send($message);
    }
}
