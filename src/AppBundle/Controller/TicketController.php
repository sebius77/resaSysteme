<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TicketController extends Controller {

    public function indexAction()
    {
        return $this->render('AppBundle:Ticket:index.html.twig');
    }

}