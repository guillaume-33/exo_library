<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/email" , name="mail")
     */
    public function SendMail(MailerInterface $mailer, Email $email){
        $email= (new TemplatedEmail())
            ->from('todo@exemple.com')
            ->to('client@exemple.com')
            ->subject('Invitation a utiliser TODO')
            ->text('Un utilisateur de TODO vous invite a nous rejoindre. Cliquez sur ce lien pour vous inscrire');

        $mailer->send($email);

    }

}