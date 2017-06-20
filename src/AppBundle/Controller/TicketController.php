<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller {

    /**
     * @Route("/ticketing", name="ticketing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $commande = new Commande();
        $form = $this->get('form.factory')->create(CommandeType::class, $commande);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Votre commande est enregistrée');

            return $this->redirectToRoute('????');
        }

        return $this->render('AppBundle:Ticket:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     *
     * @Route("/calculBillet", name="calculBillet")
     *
     */
    public function calculAction(Request $request)
    {


    }

}