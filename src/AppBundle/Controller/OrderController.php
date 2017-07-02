<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller {



    /**
     * @Route("/order/prepare", name="orderPrepare")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function orderPrepareAction(Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('commande');

        $prixCommande = $commande->getPrixCommande();
        $prixCommande = $prixCommande * 100;

        return $this->render('AppBundle:order:prepare.html.twig', array(
            'commande' => $commande,
            'prixCommande' => $prixCommande
        ));
    }


    /**
     * @Route(
     *     "/checkout",
     *     name="order_checkout",
     *     methods="POST"
     * )
     */
    public function checkoutAction(Request $request)
    {

        $session = $request->getSession();
        $commande = $session->get('commande');

        $stripeService = $this->get('app.paiementStripe');

        $paiement = $stripeService->paiementCommande($commande);

        if($paiement)
        {
            
            $mail = $this->get('app.envoiMail');
            $mail->sendMail($commande);

            // On fait appel à l'EntityManager pour enregistrer la commande en base.
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($commande);
            //$em->flush();


            $this->addFlash("success","Votre paiement est validé!!!");
            return $this->redirectToRoute("orderPrepare");
        } else
        {
            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("orderPrepare");
        }
    }

}