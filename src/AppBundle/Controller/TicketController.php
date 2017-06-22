<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Billet;
use AppBundle\Entity\Commande;
use AppBundle\Form\BilletType;
use AppBundle\Form\CommandeBilletType;
use AppBundle\Form\CommandeJourType;
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
        $form = $this->get('form.factory')->create(CommandeJourType::class, $commande);


        // Si le formulaire est renseigné et validé,
        // On vérifie que les champs sont valides
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            // Test pour connaitre la disponibilité des billets
            $em = $this->getDoctrine()->getManager();

            // Utilisation d'un repository pour avoir la somme de tous les
            // billets pour le jour sélectionné

            $stockBillet = $em->getRepository('AppBundle:Commande')->calculTotalBilletJour($commande->getDateReservation());

            $stockBillet = (int) $stockBillet[0][1];

            $stockRestant = 1000 - $stockBillet;

            // nombre billet
            $nbreBillet = $commande->getNbreBillet();

            // On récupère le service pour vérifier la disponibilité du stock
            $stock = $this->container->get('app.stock');

            // Si le stock est insuffisant, on renvoi au formulaire avec un message
            if($stock->insuffisant($stockBillet,$nbreBillet))
            {
                $request->getSession()->getFlashBag()->add('notice',
                    'Il n\, y a plus suffisament de places pour ce jour. Le stock est de : ' . $stockRestant);

                return $this->redirectToRoute('ticketing');
            }

            // Dans le cas ou tout est ok, on persist la commande
            $em->persist($commande);
            // Puis on enregistre la commande dans la base
            $em->flush();



            return $this->redirectToRoute('choixBillet', array(
                'id' => $commande->getId(),
            ));

        }

        return $this->render('AppBundle:Ticket:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @Route("/choixBillet/{id}", name="choixBillet")
     * @return
     */
    public function CommandeAction($id)
    {

        $commande = new Commande();

        $recupCommande = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Commande')
            ->find($id)
        ;


        $formBillet = $this->get('form.factory')->create(CommandeBilletType::class, $commande);


        // Si le formulaire est renseigné et validé,
        // On vérifie que les champs sont valides
        if($request->isMethod('POST') && $formBillet->handleRequest($request)->isValid()) {


        }




        return $this->render('AppBundle:Ticket:billet.html.twig', array(
            'formBillet' => $formBillet->createView(),
            'nbreBillet' => $recupCommande->getNbreBillet()
        ));


    }

}