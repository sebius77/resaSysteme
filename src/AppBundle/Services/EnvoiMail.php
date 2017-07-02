<?php
// src/AppBundle/Services/EnvoiMail.php


namespace AppBundle\Services;

use AppBundle\Entity\Commande;
use Symfony\Component\Templating\EngineInterface;

class EnvoiMail {

    protected $mailer;
    protected $templating;
    private $from = "octicketing@gmail.com";
    private $reply = "octicketing@gmail.com";
    private $name = "Billetterie du louvre";


    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }


    protected function sendMessage($to, $subject,$commande)
    {
        $mail = \Swift_Message::newInstance();
        $logo = $mail->embed(\Swift_Image::fromPath('./images/logo.png'));
        $mail
            ->setFrom($this->from,$this->name)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody( $this->templating->render('AppBundle:order:mail.html.twig',
                array('commande' => $commande, 'image' => $logo)))
            ->setReplyTo($this->reply,$this->name)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }

    public function sendMail(Commande $commande) {
        $subject = "Commande n° " . uniqid();
        $to = $commande->getMail();
        $this->sendMessage($to, $subject, $commande);
    }



}













/*
$mail = new \Swift_Message('test');

$mail
->setFrom('gebs.dev@gmail.com')
->setTo('sebgaudin@yahoo.fr')
->setSubject('Sujet test')
->setBody('test envoi')
->setReplyTo('gebs.dev@gmail.com')
->setContentType('text/html');


$mailer = $this->get('mailer');

$mailer->send($mail);

*/



