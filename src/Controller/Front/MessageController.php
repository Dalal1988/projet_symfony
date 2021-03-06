<?php

namespace App\Controller\Front;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;



class MessageController extends AbstractController
{

    /**
     * @Route("contact", name="contact")
     */

    public function contact()
    {
        return $this->render('front/contact.html.twig');
    }

    
    /**
     * @Route("message", name="message")
     */

    public function message(Request $request, MailerInterface $mailerInterface)
    {

        $message = $request->request->get('message');

        $email = (new TemplatedEmail())
            ->from('dd@test.com')
            ->to('gg@test.com')
            ->subject('message')
            ->htmlTemplate('front/email.html.twig')
            ->context(['message' => $message]);

        $mailerInterface->send($email);

        return $this->redirectToRoute('contact');
    }
}
