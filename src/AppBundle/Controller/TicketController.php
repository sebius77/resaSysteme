<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class TicketController extends Controller {

    /**
     * @Route("/ticketing", name="ticketing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $commande = new Commande();
        $form = $this->get('form.factory')->create(CommandeType::class, $commande);


        // Si le formulaire est renseigné et validé,
        // On vérifie que les champs sont valides
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            // Test pour connaitre la disponibilité des billets
            $em = $this->getDoctrine()->getManager();

            // Utilisation d'un repository pour avoir la somme de tous les
            // billets pour tel jour

            $stockBillet = $em->getRepository('AppBundle:Commande')->calculTotalBilletJour($commande->getDateReservation());

            $stockBillet = (int) $stockBillet[0][1];

            $stockRestant = 1000 - $stockBillet;

            // nombre billet
            $billet = $commande->getNbreBillet();

            // On récupère le service pour vérifier la disponibilité du stock
            $stock = $this->container->get('app.stock');

            // Si le stock est insuffisant, on renvoi au formulaire avec un message
            if($stock->insuffisant($stockBillet,$billet))
            {
                $request->getSession()->getFlashBag()->add('notice',
                    'Il n\, y a plus suffisament de places pour ce jour. Le stock est de : ' . $stockRestant);

                return $this->redirectToRoute('ticketing');
            }


            // Dans le cas ou tout est ok
            return $this->render('AppBundle:Ticket:billet.html.twig');

        }

        return $this->render('AppBundle:Ticket:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     *
     * @Route("/billet", name="billet")
     *
     */
    public function billetAction(Request $request)
    {

    }


}