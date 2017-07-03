<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Billet;
use AppBundle\Form\CommandeConfirmType;
use AppBundle\Form\CommandeType;
use AppBundle\Form\CommandeJourType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller {

    /**
     * @Route("/ticketing", name="ticketing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $commande = new Commande();

        // On récupère le service pour vérifier si - de 14h ou plus
        $limit = $this->container->get('app.limit');

        $form = $this->get('form.factory')->create(CommandeJourType::class, $commande);

        // Si le formulaire est renseigné et validé,
        // On vérifie que les champs sont valides
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $jourResa = $commande->getDateReservation();
            $demiJournee = $commande->getDemiJournee();

            if($limit->estDepassee($jourResa) && ($demiJournee === false)) {

                $request->getSession()->getFlashBag()->add('notice', 'Vous souhaitez réservez sur la journée alors qu\'
                 il est 14h passé');
                return $this->redirectToRoute('ticketing');
            }

            // On fait appel à l'entityManager
            $em = $this->getDoctrine()->getManager();

            // Utilisation d'un repository pour avoir la somme de tous les
            // billets pour le jour sélectionné
            $stockBillet = $em->getRepository('AppBundle:Commande')->calculTotalBilletJour($commande->getDateReservation());


            // nombre billet
            $nbreBillet = $commande->getNbreBillet();

            // On récupère le service pour vérifier la disponibilité du stock
            $stock = $this->container->get('app.stock');

            // Si le stock est insuffisant, on renvoi au formulaire avec un message
            if($stock->insuffisant($stockBillet,$nbreBillet))
            {
                $request->getSession()->getFlashBag()->add('notice',
                    'Il n\, y a plus suffisament de places pour ce jour. Le stock restant est de : ' . $stockBillet[0][1]);

                return $this->redirectToRoute('ticketing');
            }

            // On ajout les billets à la commande
            for($i=1; $i <= $nbreBillet; $i++)
            {
                $billet = new Billet();
                $commande->addBillet($billet);
            }

            $session = $request->getSession();
            $session->set('commande', $commande);


            // On va à l'étape suivante
            return $this->redirectToRoute('choixBillet');

        }


        return $this->render('AppBundle:Ticket:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @param Request $request
     * @Route("/choixBillet", name="choixBillet")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function billetAction(Request $request)
    {

        // On récupère la commande de la session
        $commande = $request->getSession()->get('commande');

        // Dans le cas ou l'on tenterait d'accéder à la page sans être passé par l'étape 1
        if($commande === null)
        {
            return $this->redirectToRoute('ticketing');
        }

       $form = $this->get('form.factory')->create(CommandeType::class, $commande);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            // on appelle le service app.verifCat pour déterminer la catégorie du billet
            $verifCat = $this->container->get('app.verifCat');

            // On récupère tous les billets de la commande
            $billets = $commande->getBillets();

            // Je fais appel au repository pour effectuer une recherche sur l'entité categorie
            $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Categorie');

            // Boucle pour l'ajout des catégories aux billets
            foreach($billets as $billet)
            {
                // Pour chaque billet, je récupère la date de naissance
                $birthday = $billet->getDateNaissance();

                // On utilise la méthode du service verifCat pour récupérer les
                // catégories des différents billets en fonction des dates
                $cat = $verifCat->determineCat($birthday);

                // En fonction du nom de la catégorie, nous récupérons l'oblet catégorie
                // avec tout ses attributs
                $categorie = $repository->findOneBy(array('nom' => $cat));

                // Puis si la catégorie existe, nous ajoutons la catégorie au billet
                // Si la catégorie n'existe pas avec la date renseignée
                // Cela signifie que le billet est gratuit et qu'il s'agit d'un enfant
                // de moins de 4 ans


                if($categorie != null)
                {
                    if(($categorie->getNom() === 'normal') && ($billet->getTarifReduit() === true))
                    {
                        $categorie = $repository->findOneBy(array('nom' => 'reduit'));
                        $billet->setValid(true);
                    } else if ($billet->getTarifReduit() === true)
                    {
                        $billet->setValid(false);
                    }
                    $billet->setCategorie($categorie);


                } else {

                    // Cas pour une date correspondant à un enfant de moins de 4 ans
                    $request->getSession()->getFlashBag()->add('notice', 'Pour les enfants de moins de 4ans l\'entrée est gratuite');
                    return $this->redirectToRoute('choixBillet');

                }

                $validator = $this->get('validator');
                $listErrors = $validator->validate($billet);

                // Si une erreur est levé, nous envoyons un message pour indiquer qu'un des billets
                // ne peut bénéficier du tarif réduit
                if(count($listErrors) > 0)
                {
                    $request->getSession()->getFlashBag()->add('notice', 'Un billet ne peut bénéficier du tarif réduit');
                    return $this->redirectToRoute('choixBillet');
                }

            }

            return $this->redirectToRoute('verifCat');
        }


       return $this->render('AppBundle:Ticket:billet.html.twig', array(
           'form' => $form->createView(),
           'nbreBillet' => $commande->getNbreBillet()
       ));

    }


    /**
     * @param Request $request
     * * @Route("/verifCat", name="verifCat")
     * * * @return \Symfony\Component\HttpFoundation\Response
     */
    public function verifCategorie(Request $request)
    {

        $session = $request->getSession();
        $commande = $session->get('commande');

        $prixCommande = $this->get('app.prixCommande');
        $totalCommande = $prixCommande->calculTotal($commande);

        $commande->setPrixCommande($totalCommande);


        return $this->redirectToRoute('recapCommande');

    }


    /**
     * @param Request $request
     * * * @Route("/recapCommande", name="recapCommande")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recapCommande(Request $request)
    {

        $session = $request->getSession();
        $commande = $session->get('commande');


        $form = $this->get('form.factory')->create(CommandeConfirmType::class, $commande);


        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {

            return $this->redirectToRoute('orderPrepare');

        }



        return $this->render('AppBundle:Ticket:recap.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView()

        ));
    }











    /**
     * @param Request $request
     * @Route("/checkDate", name="checkDate")
     * * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkDateAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $date = $request->get('cle');
        }
        // Checker la date
        return new JsonResponse(['test' => 'reponse AJAX']);
    }


}